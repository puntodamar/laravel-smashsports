<?php

namespace Modules\Schedule\Models;

use Carbon\CarbonImmutable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Facades\DB;

class CourtSchedule extends Model
{
    protected $fillable = ['court_id', 'date', 'start_time', 'end_time', 'price', 'owner_id'];

    protected $casts = [
        'date' => 'date:Y-m-d',
        'price' => 'integer',
    ];

    public function court(): BelongsTo
    {
        return $this->belongsTo(Court::class);
    }

    public function booking(): HasOne
    {
        return $this->hasOne(CourtBooking::class, 'court_schedule_id');
    }


    public function getStartAtAttribute(): CarbonImmutable
    {
        return CarbonImmutable::parse($this->date->format('Y-m-d') . ' ' . $this->start_time);
    }

    public function getEndAtAttribute(): CarbonImmutable
    {
        return CarbonImmutable::parse($this->date->format('Y-m-d') . ' ' . $this->end_time);
    }

    /** Scope: schedules on a specific calendar date */
    public function scopeOnDate(Builder $q, $date): Builder
    {
        return $q->whereDate('date', $date);
    }

    public function scopeForCourt(Builder $q, int $courtId): Builder
    {
        return $q->where('court_id', $courtId);
    }

    /**
     * Scope: available for INCIDENTAL bookings.
     * - No existing booking
     * - NOT overlapped by a blackout with scope = 'all'
     * (membership-only blackouts do NOT block incidental)
     */
    public function scopeAvailableForIncidental(Builder $q): Builder
    {
        return $q
            ->whereDoesntHave('booking')
            ->whereRaw("
                NOT EXISTS (
                  SELECT 1 FROM schedule_blackouts b
                  WHERE b.court_id = court_schedules.court_id
                    AND b.scope = 'all'
                    AND b.start_at < (court_schedules.date::timestamp + court_schedules.end_time::time)
                    AND b.end_at   > (court_schedules.date::timestamp + court_schedules.start_time::time)
                )
            ");
    }

    /**
     * Scope: available for MEMBERSHIP bookings.
     * - No existing booking
     * - NOT overlapped by ANY blackout (scope 'all' OR 'membership_only')
     */
    public function scopeAvailableForMembership(Builder $q): Builder
    {
        return $q
            ->whereDoesntHave('booking')
            ->whereRaw("
                NOT EXISTS (
                  SELECT 1 FROM schedule_blackouts b
                  WHERE b.court_id = court_schedules.court_id
                    AND b.start_at < (court_schedules.date::timestamp + court_schedules.end_time::time)
                    AND b.end_at   > (court_schedules.date::timestamp + court_schedules.start_time::time)
                )
            ");
    }

    public static function findAvailableSchedules(string $membershipType, string|\DateTimeInterface $date): Collection
    {
        $d = $date instanceof \DateTimeInterface ? $date->format('Y-m-d') : $date;

        $startSql = "(court_schedules.date::timestamp + court_schedules.start_time::time)";
        $endSql = "(court_schedules.date::timestamp + court_schedules.end_time::time)";

        $scopeFilter = $membershipType === 'incidental' ? "AND b.scope = 'all'" : "";

        return static::with('court')
            ->whereDate('date', $d)
            ->whereDoesntHave('booking')
            ->whereRaw("
                NOT EXISTS (
                  SELECT 1
                  FROM schedule_blackouts b
                  WHERE b.court_id = court_schedules.court_id
                    AND b.start_at < {$endSql}
                    AND b.end_at   > {$startSql}
                    {$scopeFilter}
                )
            ")
            ->orderBy('court_id')
            ->orderBy('start_time')
            ->get();
    }

    /**
     * generate schedule if not created yet
     */


// app/Models/CourtSchedule.php

    public static function ensureForDate(string|\DateTimeInterface $date, ?int $ownerId): void
    {
        $d = $date instanceof \DateTimeInterface ? $date->format('Y-m-d') : $date;

        DB::statement(<<<'SQL'
            WITH hours AS (
                SELECT generate_series(8,23) AS h
            ),
            slots AS (
                SELECT
                    c.id                  AS court_id,
                    (:date)::date         AS date,
                    make_time(h,0,0)      AS start_time_val,                                    -- TIME (not null)
                    CASE WHEN h < 23 THEN make_time(h+1,0,0) ELSE time '23:59:59' END AS end_time_val,
                    lpad(h::text,2,'0') || ':00'                            AS start_txt,       -- "08:00"
                    CASE WHEN h < 23 THEN lpad((h+1)::text,2,'0') || ':00' ELSE '24:00' END AS end_txt, -- "09:00"/"24:00"
                    (lpad(h::text,2,'0') || ':00' || ' ' ||
                     CASE WHEN h < 23 THEN lpad((h+1)::text,2,'0') || ':00' ELSE '24:00' END)  AS time_str, -- "08:00 09:00"
                    h
                FROM courts c
                CROSS JOIN hours
            ),
            priced AS (
                SELECT
                    s.court_id,
                    s.date,
                    s.start_time_val,
                    s.end_time_val,
                    s.time_str,
                /* insidental */
                COALESCE(ov_i.price,
                         ru_i.price,
                         CASE WHEN s.h BETWEEN 17 AND 21 THEN 60000 ELSE 50000 END
                )::int AS incidental_price,
                /* membership */
                COALESCE(ov_m.price,
                         ru_m.price,
                         ROUND( (CASE WHEN s.h BETWEEN 17 AND 21 THEN 60000 ELSE 50000 END)::numeric - 10000 )
                )::int AS membership_price
                FROM slots s
                /* date-specific overrides */
                LEFT JOIN LATERAL (
                    SELECT o.price
                    FROM price_overrides o
                    WHERE (o.court_id = s.court_id OR o.court_id IS NULL)
                        AND o.applies_to IN ('incidental','both')
                        AND o.date = s.date
                        AND o.start_time < s.end_time_val
                        AND o.end_time   > s.start_time_val
                    ORDER BY o.court_id NULLS LAST, o.start_time DESC
                    LIMIT 1
                ) ov_i ON TRUE
                    LEFT JOIN LATERAL (
                    SELECT o.price
                    FROM price_overrides o
                    WHERE (o.court_id = s.court_id OR o.court_id IS NULL)
                        AND o.applies_to IN ('membership','both')
                        AND o.date = s.date
                        AND o.start_time < s.end_time_val
                        AND o.end_time   > s.start_time_val
                        ORDER BY o.court_id NULLS LAST, o.start_time DESC
                    LIMIT 1
                ) ov_m ON TRUE
              /* weekday/time rules (string weekday in rules) */
              LEFT JOIN LATERAL (
                    SELECT r.price
                    FROM price_rules r
                    WHERE (r.court_id = s.court_id OR r.court_id IS NULL)
                        AND r.applies_to IN ('incidental','both')
                        AND r.weekday = (ARRAY['Sun','Mon','Tue','Wed','Thu','Fri','Sat'])[EXTRACT(DOW FROM s.date)::int + 1]
                        AND r.start_time <= s.start_time_val
                        AND r.end_time   >  s.start_time_val
                        AND (r.valid_from IS NULL OR r.valid_from <= s.date)
                        AND (r.valid_to   IS NULL OR r.valid_to   >= s.date)
                    ORDER BY r.court_id NULLS LAST, r.priority DESC
                    LIMIT 1
              ) ru_i ON TRUE
              LEFT JOIN LATERAL (
                    SELECT r.price
                        FROM price_rules r
                        WHERE (r.court_id = s.court_id OR r.court_id IS NULL)
                        AND r.applies_to IN ('membership','both')
                        AND r.weekday = (ARRAY['Sun','Mon','Tue','Wed','Thu','Fri','Sat'])[EXTRACT(DOW FROM s.date)::int + 1]
                        AND r.start_time <= s.start_time_val
                        AND r.end_time   >  s.start_time_val
                        AND (r.valid_from IS NULL OR r.valid_from <= s.date)
                        AND (r.valid_to   IS NULL OR r.valid_to   >= s.date)
                        ORDER BY r.court_id NULLS LAST, r.priority DESC
                        LIMIT 1
              ) ru_m ON TRUE
            ),
            owner AS (
                SELECT COALESCE(:owner_id::bigint, (SELECT id FROM users ORDER BY id LIMIT 1)) AS owner_id
            )
            INSERT INTO court_schedules
                (court_id, date, start_time, end_time, time_slot,
                price, membership_price, owner_id, is_blocked, created_at, updated_at)
            SELECT
                p.court_id,
                p.date,
                p.start_time_val,
                p.end_time_val,
                p.time_str,
                p.incidental_price,
                p.membership_price,
                o.owner_id,
                FALSE,               -- ensure NOT NULL boolean
                now(), now()
            FROM priced p
            CROSS JOIN owner o
            ON CONFLICT (court_id, date, time_slot) DO NOTHING;
            SQL, ['date' => $d, 'owner_id' => $ownerId]);
    }




}
