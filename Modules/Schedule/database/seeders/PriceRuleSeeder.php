<?php

namespace Modules\Schedule\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Modules\Schedule\Models\PriceRule;

class PriceRuleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if (!PriceRule::exists()) {
            $dayPrice = 50000;
            $nightPrice = 60000;
            $memberDay = $dayPrice - 10000;
            $memberNight = $nightPrice - 10000;

            $rows = [];
            $now = now();

            foreach (['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'] as $weekday) {
                // insidental day
                $rows[] = [
                    'court_id' => null,
                    'applies_to' => 'incidental',
                    'weekday' => $weekday,
                    'start_time' => '08:00:00',
                    'end_time' => '17:00:00',
                    'price' => $dayPrice,
                    'priority' => 0,
                    'valid_from' => null,
                    'valid_to' => null,
                    'active' => true,
                    'created_at' => $now,
                    'updated_at' => $now
                ];

                // insidental night

                $rows[] = [
                    'court_id' => null,
                    'applies_to' => 'incidental',
                    'weekday' => $weekday,
                    'start_time' => '17:00:00',
                    'end_time' => '23:59:59',
                    'price' => $nightPrice,
                    'priority' => 0,
                    'valid_from' => null,
                    'valid_to' => null,
                    'active' => true,
                    'created_at' => $now,
                    'updated_at' => $now];


                // membership day
                $rows[] = [
                    'court_id' => null,
                    'applies_to' => 'membership',
                    'weekday' => $weekday,
                    'start_time' => '08:00:00',
                    'end_time' => '17:00:00',
                    'price' => $memberDay,
                    'priority' => 0,
                    'valid_from' => null,
                    'valid_to' => null,
                    'active' => true,
                    'created_at' => $now,
                    'updated_at' => $now
                ];


                // member night
                $rows[] = [
                    'court_id' => null,
                    'applies_to' => 'membership',
                    'weekday' => $weekday,
                    'start_time' => '17:00:00',
                    'end_time' => '23:59:59',
                    'price' => $memberNight,
                    'priority' => 0,
                    'valid_from' => null,
                    'valid_to' => null,
                    'active' => true,
                    'created_at' => $now,
                    'updated_at' => $now
                ];
            }

            DB::table('price_rules')->insert($rows);
        }
    }
}
