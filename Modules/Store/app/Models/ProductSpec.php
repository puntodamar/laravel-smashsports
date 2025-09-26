<?php

namespace Modules\Store\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Modules\Store\Database\Factories\ProductSpecFactory;

class ProductSpec extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = ['product_id', 'label', 'description', 'sort_order'];

    // protected static function newFactory(): ProductSpecFactory
    // {
    //     // return ProductSpecFactory::new();
    // }
}
