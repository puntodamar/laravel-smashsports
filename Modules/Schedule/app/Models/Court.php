<?php

namespace Modules\Schedule\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Court extends Model
{
    protected $fillable = ['name'];
    public $timestamps = false;

    public function schedules(): HasMany
    {
        return $this->hasMany(CourtSchedule::class);
    }

    public function memberships(): HasMany
    {
        return $this->hasMany(Membership::class);
    }

    public function blackouts(): HasMany
    {
        return $this->hasMany(ScheduleBlackout::class);
    }
}
