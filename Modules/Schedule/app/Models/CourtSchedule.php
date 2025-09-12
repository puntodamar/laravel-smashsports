<?php

namespace Modules\Schedule\Models;

use Carbon\CarbonImmutable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class CourtSchedule extends Model
{
    protected $fillable = [
        'court_id','date','start_time','end_time','price',
    ];

    protected $casts = [
        'date' => 'date:Y-m-d', // stored as DATE
        // start_time / end_time are TIME; keep as strings, and expose combined datetimes below
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

    /** Combined start/end as immutable Carbon (server TZ) */
    public function getStartAtAttribute(): CarbonImmutable
    {
        return CarbonImmutable::parse($this->date->format('Y-m-d').' '.$this->start_time);
    }

    public function getEndAtAttribute(): CarbonImmutable
    {
        return CarbonImmutable::parse($this->date->format('Y-m-d').' '.$this->end_time);
    }

    /** Scope: schedules on a specific calendar date */
    public function scopeOnDate(Builder $q, $date): Builder
    {
        return $q->whereDate('date', $date);
    }

    /** Scope: schedules for a court id */
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
}
