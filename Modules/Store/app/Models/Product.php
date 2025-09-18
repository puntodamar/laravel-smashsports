<?php

namespace Modules\Store\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Modules\Store\Database\Factories\ProductFactory;

class Product extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = ['name', 'product_type', 'description', 'price'];

    public function images()
    {
        return $this->hasMany(ProductImage::class)->orderBy('sort_order');
    }

    public function primaryImage($query)
    {
        return $query->where('is_primary', true);
    }

    public function resolveRouteBinding($value, $field = null)
    {
        $typeSlug  = request()->route('product_type');
        $productId = request()->route('product_id');

        return $this->newQuery()
            ->select('products.*')
            ->join('product_types as pt', 'pt.id', '=', 'products.product_type')
            ->where('products.' . ($field ?? $this->getRouteKeyName()), $value)
            ->when($typeSlug, fn ($q) => $q->where('pt.slug', $typeSlug))
            ->when($productId, fn ($q) => $q->where('products.slug', $productId))
            // handle soft delete
//            ->when(in_array('Illuminate\\Database\\Eloquent\\SoftDeletes', class_uses_recursive(static::class)),
//                fn ($q) => $q->whereNull('products.deleted_at')
//            )
            ->firstOrFail();
    }
}
