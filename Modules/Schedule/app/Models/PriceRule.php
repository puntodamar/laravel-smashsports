<?php

namespace Modules\Schedule\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Modules\Schedule\Database\Factories\PriceRuleFactory;

class PriceRule extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = ['court_id', 'applies_to', 'weekday', 'start_time', 'end_time', 'price', 'priority', 'valid_from', 'valid_to', 'active', 'created_at', 'updated_at'];

    // protected static function newFactory(): PriceRuleFactory
    // {
    //     // return PriceRuleFactory::new();
    // }
}
