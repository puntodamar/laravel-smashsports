<?php

namespace Modules\Store\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Modules\Store\Models\Product;
use Modules\Store\Models\ProductType;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $raketYonex = ProductType::where('slug', 'raket.yonex')->first();
        $raketLining = ProductType::where('slug', 'raket.lining')->first();

        $sepatuYonex = ProductType::where('slug', 'sepatu.yonex')->first();

        if (!Product::exists()) {
            $products = [
                [
                    "name" => "Yonex 1000 Z",
                    "product_type_id" => $raketYonex->id,
                    "price" => 3000000,
                    "description" => 'For advanced players looking for immediate access to power to maintain a relentless attack',
                    'product_variants' => [
                        ["name" => "G5", "amount" => 5],
                        ["name" => "G6", "amount" => 0],
                    ],
                    "product_specs" => [
                        ["label" => "Flex", "description" => "Stiff"],
                        ["label" => "Frame", "description" => "HM Graphite, NANOMETRIC DR, M40X, EX-HYPER MG"],
                        ["label" => "Tarikan Senar", "description" => "4U: 20 - 28 lbs <br/> 3U: 21 - 29 lbs"],
                        ["label" => "Shaft", "description" => "HM Graphite, Ultra PE FIBER"],
                    ],
                ],
                [
                    "name" => "Lining Axforce 90 White Tiger",
                    "product_type_id" => $raketLining->id,
                    "price" => 3250000,
                    "description" => 'For advanced players looking for immediate access to power to maintain a relentless attack',
                    'product_variants' => [
                        ["name" => "G5", "amount" => 5],
                        ["name" => "G6", "amount" => 0],
                    ],
                    "product_specs" => [
                        ["label" => "Flex", "description" => "Stiff"],
                        ["label" => "Frame", "description" => "HM Graphite, NANOMETRIC DR, M40X, EX-HYPER MG"],
                        ["label" => "Tarikan Senar", "description" => "4U: 20 - 28 lbs <br/> 3U: 21 - 29 lbs"],
                        ["label" => "Shaft", "description" => "HM Graphite, Ultra PE FIBER"],
                    ],
                ],
                [
                    "name" => "Lining Windstorm 72 Nano",
                    "product_type_id" => $raketLining->id,
                    "price" => 1300000,
                    "description" => 'For advanced players looking for immediate access to power to maintain a relentless attack',
                    'product_variants' => [
                        ["name" => "G5", "amount" => 5],
                        ["name" => "G6", "amount" => 0],
                    ],
                    "product_specs" => [
                        ["label" => "Flex", "description" => "Stiff"],
                        ["label" => "Frame", "description" => "HM Graphite, NANOMETRIC DR, M40X, EX-HYPER MG"],
                        ["label" => "Tarikan Senar", "description" => "4U: 20 - 28 lbs <br/> 3U: 21 - 29 lbs"],
                        ["label" => "Shaft", "description" => "HM Graphite, Ultra PE FIBER"],
                    ],
                ],
                [
                    "name" => "Yonex Astrox 22 RX",
                    "product_type_id" => $raketYonex->id,
                    "price" => 3000000,
                    "description" => 'For advanced players looking for immediate access to power to maintain a relentless attack',
                    'product_variants' => [
                        ["name" => "G5", "amount" => 5],
                        ["name" => "G6", "amount" => 0],
                    ],
                    "product_specs" => [
                        ["label" => "Flex", "description" => "Stiff"],
                        ["label" => "Frame", "description" => "HM Graphite, NANOMETRIC DR, M40X, EX-HYPER MG"],
                        ["label" => "Tarikan Senar", "description" => "4U: 20 - 28 lbs <br/> 3U: 21 - 29 lbs"],
                        ["label" => "Shaft", "description" => "HM Graphite, Ultra PE FIBER"],
                    ],
                ],

                // sepatu
                [
                    "name" => "Yonex SHB 65 Power Cushion",
                    "product_type_id" => $sepatuYonex->id,
                    "price" => 2000000,
                    "description" => 'Yonex SHB 65 X3 is a great pair of badminton shoes. This pair of shoes has Power Cushion+ integrated in the sole of the shoe! The Power Cushion+-technology is 25 percent more shock-absorbing than the original Power Cushion. In addition to great shock absorption, the Yonex SHB 65 X3 is known for great stability in both the forefoot and heel of the shoe. At last, the reinforced upper, also known as the Lateral Shell, provides a solid support when changing direction.',
                    'product_variants' => [
                        ["name" => "40", "amount" => 5],
                        ["name" => "42", "amount" => 0],
                    ],
                    "product_specs" => [
                        ["label" => "Upper", "description" => "Synthetic Leather"],
                        ["label" => "Midsole", "description" => "Synthetic Resin"],
                        ["label" => "Outsole", "description" => "Rubber Sole"],
                        ["label" => "Material", "description" => "POWER CUSHION +, Power Graphite Lite, Seameless Upper, Inner Bootie, Ergonomic Shaped Outsole"],
                    ],
                ],
            ];

            DB::transaction(function () use ($products) {
                foreach ($products as $product) {
                    $this->createProduct($product);
                }
            });
        }
    }

    private function createProduct(array $p): void
    {
        $product = Product::create(array_merge(
            Arr::except($p, ['product_specs', 'product_variants']),
            ['slug' => Str::slug($p['name'], '-')]
        ));

        if (! empty($p['product_variants'])) {
            $product->variants()->createMany($p['product_variants']);
        }

        foreach($p['product_specs'] as $i => $spec) {
            $spec = array_merge($spec, ['sort_order' => $i]);
            $product->specs()->create($spec);
        }
    }
}
