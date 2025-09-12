<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CourtBooking extends Model
{

    public function schedule(): BelongsTo {
        return $this->belongsTo(CourtSchedule::class);
    }
}
