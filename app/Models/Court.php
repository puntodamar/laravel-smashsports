<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Court extends Model
{
    public function schedules(): HasMany {
        return $this->hasMany(CourtSchedule::class);
    }
}
