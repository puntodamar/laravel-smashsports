<?php

namespace Modules\Store\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Modules\Store\Models\ProductType;

class StoreDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if(!ProductType::exists()) {
            $types = [
                ["name" => "Raket", "slug" => "raket",
                    "children" => [
                        ["name" => "Paket Hemat", "type" => "category"],
                        ["name" => "Pro Series", "type" => "category"],

                        ["name" => "Terbaru", "type" => "collection"],
                        ["name" => "Diskon", "type" => "category"],

                        ["name" => "Yonex","type" => "brand" ],
                        ["name" => "Lining", "type" => "brand" ]
                    ]],
                ["name" => "Sepatu", "slug" => "shoes",
                    "children" => [
                        ["name" => "Terbaru", "type" => "collection"],
                        ["name" => "Diskon", "type" => "category"],

                        ["name" => "Yonex","type" => "brand" ],
                        ["name" => "Lining", "type" => "brand" ]
                    ]],
                ["name" => "Tas", "slug" => "tas",
                    "children" => [
                        ["name" => "Terbaru", "type" => "collection"],
                        ["name" => "Diskon", "type" => "category"],

                        ["name" => "Yonex", "type" => "brand" ],
                        ["name" => "Lining", "type" => "brand" ]
                    ]],
                ["name" => "Apparel", "slug" => "apparel",
                    "children" => [
                        ["name" => "Terbaru", "type" => "collection"],
                        ["name" => "Diskon", "type" => "category"],

                        ["name" => "Yonex", "type" => "brand" ],
                        ["name" => "Lining", "type" => "brand" ]
                    ]],
                ["name" => "Asesoris", "slug" => "asesoris",
                    "children" => [
                        ["name" => "Grip", "type" => "category" ],
                        ["name" => "Senar", "type" => "category" ],
                    ]],
                ["name" => "Shuttlecocks", "slug" => "shuttlecocks",
                    "children" => [
                        ["name" => "Yonex", "type" => "brand"],
                        ["name" => "Lining", "type" => "brand"]
                    ]],
            ];

            DB::transaction(function () use ($types) {
                foreach ($types as $type) {
                    $this->createProductType($type);
                }
            });
        }
    }

    private function createProductType(array $type, ?ProductType $parent = null): void {
        $slug = Str::slug($type['name']);

        if ($parent) {
            $slug = trim($parent->slug, '.') . '.' . trim($slug, '.');
        }

        $payload = [
            'name'      => $type['name'],
            'slug'      => $slug,
            'parent_id' => $parent?->id,
            'type' => $type['type'] ?? null,
        ];
        $productType = ProductType::create($payload);

        foreach ($type['children'] ?? [] as $child) {
            $this->createProductType($child, $productType);
        }

    }
}
