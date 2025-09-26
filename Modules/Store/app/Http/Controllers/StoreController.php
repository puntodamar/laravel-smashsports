<?php

namespace Modules\Store\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Modules\Store\Models\Product;
use Modules\Store\Models\ProductType;

class StoreController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

//        $baseProduct = Product::query()
//            ->with(['primaryImage:path'])
//            ->orderBy('created_at', 'desc')->select('id', 'price', 'name')
//            ->limit(4);

        $baseProduct = Product::query()
            ->from('products as p')
            ->join('product_types as pt', 'pt.id', '=', 'p.product_type_id')
            ->leftJoin('product_images as img', function ($j) {
                $j->on('img.product_id', '=', 'p.id')->where('img.is_primary', 1);
            })
            ->select([
                'p.id',
                'p.name',
                'p.price',
                'p.slug',
                'pt.slug as sub_product',
                'img.path as primary_image_path',
            ])->inRandomOrder()->limit(4);

        return Inertia::render('Module/Store/Index', [
//            'racket' => $baseProduct
//                ->whereHas('type.parent', fn ($q) => $q->where('slug', 'raket'))
//                ->get(),

            'racket' => $baseProduct->where('pt.slug', 'ILIKE', 'raket%')->get(),
            'shoes' => $baseProduct->where('pt.slug', 'ILIKE', 'sepatu%')->get(),
            'bag' => $baseProduct->where('pt.slug', 'ILIKE', 'tas%')->get(),
            'apparel' => $baseProduct->where('pt.slug', 'ILIKE', 'apparel%')->get(),
            'shuttlecocks' => $baseProduct->where('pt.slug', 'ILIKE', 'shuttlecocks%')->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('store::create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request) {}

    /**
     * Show the specified resource.
     */
    public function show(string $productType, string $subProduct, Product $product)
    {
        return Inertia::render('Module/Store/ProductDetail', [
            'product' => $product,
            'title' => $product->name,
            'relatedProducts' => Product::from('products as p')
                ->join('product_types as pt', 'pt.id', '=', 'p.product_type_id')
                ->where('pt.slug', 'ILIKE', "{$productType}%")
                ->select('p.*', 'pt.slug as sub_product')
                ->whereNotIn('p.id', [$product->id])->inRandomOrder()->limit(4)->get(),
        ]);

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        return view('store::edit');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id) {}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id) {}
}
