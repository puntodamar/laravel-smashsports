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
                        ["name" => "Yonex", "slug" => "yonex"],
                        ["name" => "Lining", "slug" => "lining",]
                    ]],
                ["name" => "Sepatu", "slug" => "shoes",
                    "children" => [
                        ["name" => "Yonex", "slug" => "yonex"],
                        ["name" => "Lining", "slug" => "lining",]
                    ]],
                ["name" => "Tas", "slug" => "tas",
                    "children" => [
                        ["name" => "Yonex", "slug" => "yonex"],
                        ["name" => "Lining", "slug" => "lining",]
                    ]],
                ["name" => "Apparel", "slug" => "apparel",
                    "children" => [
                        ["name" => "Yonex", "slug" => "yonex"],
                        ["name" => "Lining", "slug" => "lining",]
                    ]],
                ["name" => "Asesoris", "slug" => "asesoris",
                    "children" => [
                        ["name" => "Grip", "slug" => "grip"],
                    ]],
                ["name" => "Senar", "slug" => "senar",
                    "children" => [
                        ["name" => "Yonex", "slug" => "yonex"],
                        ["name" => "Lining", "slug" => "lining",]
                    ]],
                ["name" => "Shuttlecocks", "slug" => "shuttlecocks",
                    "children" => [
                        ["name" => "Yonex", "slug" => "yonex"],
                        ["name" => "Lining", "slug" => "lining",]
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
        $slug = Str::slug($type['slug']);

        if ($parent) {
            $slug = trim($parent->slug, '.') . '.' . trim($slug, '.');
        }

        $payload = [
            'name'      => $type['name'],
            'slug'      => $slug,
            'parent_id' => $parent?->id,
        ];
        $productType = ProductType::create($payload);

        foreach ($type['children'] ?? [] as $child) {
            $this->createProductType($child, $productType);
        }

    }
}
