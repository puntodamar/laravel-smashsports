<?php

namespace Modules\Store\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

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

    public function variants(): HasMany
    {
        return $this->hasMany(ProductStock::class);
    }

    public function specs(): HasMany
    {
        return $this->hasMany(ProductSpec::class);
    }

    public function primaryImage(): HasOne
    {
        return $this->hasOne(ProductImage::class)->where('is_primary', true);
    }

    public function type()
    {
        return $this->belongsTo(ProductType::class, 'product_type_id');
    }

    public function resolveRouteBinding($value, $field = null)
    {
        $productType  = request()->route('product_type');
        $subProduct = request()->route('sub_product');
        $product = request()->route('product');

        return $this->newQuery()
            ->select('products.*')
            ->join('product_types as pt', 'pt.id', '=', 'products.product_type_id')
            ->join('product_stocks as ps', 'ps.product_id', '=', 'products.id')
            ->where('products.' . ($field ?? $this->getRouteKeyName()), $value)
            ->when($productType, fn ($q) => $q->where('pt.slug', $productType.".".$subProduct))
            ->when($product, fn ($q) => $q->where('products.slug', $product))
            ->with([
                'variants' => fn ($q) => $q->select('id', 'product_id', 'name', 'amount')->orderBy('amount', 'desc')
            ])
            // handle soft delete
//            ->when(in_array('Illuminate\\Database\\Eloquent\\SoftDeletes', class_uses_recursive(static::class)),
//                fn ($q) => $q->whereNull('products.deleted_at')
//            )
            ->firstOrFail();
    }
}
