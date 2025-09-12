<?php

namespace Modules\Schedule\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Modules\Schedule\Database\Factories\PriceOverrideFactory;

class PriceOverride extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [];

    // protected static function newFactory(): PriceOverrideFactory
    // {
    //     // return PriceOverrideFactory::new();
    // }
}
