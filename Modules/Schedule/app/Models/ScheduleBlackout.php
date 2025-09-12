<?php

namespace Modules\Schedule\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ScheduleBlackout extends Model
{
    protected $fillable = [
        'court_id','start_at','end_at','scope','reschedule_membership_next_week','reason','created_by',
    ];

    protected $casts = [
        'start_at' => 'immutable_datetime',
        'end_at'   => 'immutable_datetime',
        'reschedule_membership_next_week' => 'boolean',
    ];

    // 'all' or 'membership_only'
    public const SCOPE_ALL = 'all';
    public const SCOPE_MEMBERSHIP_ONLY = 'membership_only';

    public function court(): BelongsTo
    {
        return $this->belongsTo(Court::class);
    }

    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
