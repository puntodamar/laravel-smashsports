<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class CourtSchedule extends Model
{

    protected $fillable = [
        'court_id',
        'owner_id',
        'time',
        'price',
        'status'
    ];


    public function court(): BelongsTo {
        return $this->belongsTo(Court::class);
    }

    public function booking(): HasOne {
        return $this->hasOne(CourtBooking::class);
    }
}
