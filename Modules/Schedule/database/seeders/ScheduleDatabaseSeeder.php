<?php

namespace Modules\Schedule\Database\Seeders;

use App\Models\User;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Modules\Schedule\Models\Court;
use Modules\Schedule\Models\CourtSchedule;

class ScheduleDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::transaction(function () {
            // Courts
            $names  = ['Lapangan 1','Lapangan 2','Lapangan 3','Lapangan 4'];
            $courts = collect($names)->map(fn ($n) => Court::firstOrCreate(['name'=>$n]));

            $owner = User::superAdmin();


            $start = Carbon::today();
            $end   = Carbon::today()->addDays(59);

            foreach (CarbonPeriod::create($start, $end) as $d) {

                CourtSchedule::ensureForDate($d->toDateString(), $owner->id);
            }
        });
    }
}
