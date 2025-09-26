<?php

namespace Modules\Store\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class ProductStock extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = ['product_id', 'name', 'amount'];

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }


    // protected static function newFactory(): ProductStockFactory
    // {
    //     // return ProductStockFactory::new();
    // }
}
