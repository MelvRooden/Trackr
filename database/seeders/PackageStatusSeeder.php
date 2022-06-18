<?php

namespace Database\Seeders;

use App\Models\PackageStatus;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PackageStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        PackageStatus::create([
            'name' => 'registered',
        ]);

        PackageStatus::create([
            'name' => 'sortingCenter',
        ]);

        PackageStatus::create([
            'name' => 'onTheWay',
        ]);

        PackageStatus::create([
            'name' => 'delivered',
        ]);

        PackageStatus::create([
            'name' => 'registeredForPickUp',
        ]);
    }
}
