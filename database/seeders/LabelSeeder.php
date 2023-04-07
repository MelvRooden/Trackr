<?php

namespace Database\Seeders;

use App\Models\Label;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LabelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $now = Carbon::now();
        $minDate = $now->addDays(6)->setTime(0, 0)->addHours(15);

        Label::factory()->count(20)->create(['package_status_id' => 1]);
        Label::factory()->count(15)->create(['package_status_id' => 2]);
        Label::factory()->count(10)->create(['package_status_id' => 3]);
        Label::factory()->count(5)->create(['package_status_id' => 4]);
        Label::factory()->count(6)->create([
            'package_status_id' => 5,
            'pickup_datetime' => $minDate,
            'pickup_address' => 'Straat 31',
            'pickup_city' => 'Stajd',
            'pickup_postcode' => '3412AX'
        ]);
    }
}
