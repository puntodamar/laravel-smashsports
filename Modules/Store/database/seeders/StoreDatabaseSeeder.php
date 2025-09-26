<?php

namespace Modules\Store\Database\Seeders;

use Illuminate\Database\Seeder;

class StoreDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         $this->call([
             ProductTypeSeeder::class,
             ProductSeeder::class,
         ]);
    }
}
