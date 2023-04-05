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
            'id' => 1,
            'name' => 'registered',
        ]);

        PackageStatus::create([
            'id' => 2,
            'name' => 'sortingCenter',
        ]);

        PackageStatus::create([
            'id' => 3,
            'name' => 'onTheWay',
        ]);

        PackageStatus::create([
            'id' => 4,
            'name' => 'delivered',
        ]);

        PackageStatus::create([
            'id' => 5,
            'name' => 'registeredForPickUp',
        ]);
    }
}
