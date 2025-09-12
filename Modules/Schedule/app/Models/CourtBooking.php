<?php

namespace Modules\Schedule\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CourtBooking extends Model
{
    protected $fillable = [
        'user_id','court_schedule_id','type','membership_id','status','reference','rescheduled_from_booking_id',
    ];

    protected $casts = [
        'user_id'             => 'integer',
        'court_schedule_id'   => 'integer',
        'membership_id'       => 'integer',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function schedule(): BelongsTo
    {
        return $this->belongsTo(CourtSchedule::class, 'court_schedule_id');
    }

    public function membership(): BelongsTo
    {
        return $this->belongsTo(Membership::class);
    }

    public function rescheduledFrom(): BelongsTo
    {
        return $this->belongsTo(CourtBooking::class, 'rescheduled_from_booking_id');
    }
}
