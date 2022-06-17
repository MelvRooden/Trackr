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
            'name' => 'Registered',
        ]);

        PackageStatus::create([
            'name' => 'Printed',
        ]);

        PackageStatus::create([
            'name' => 'SortingCenter',
        ]);

        PackageStatus::create([
            'name' => 'OnTheWay',
        ]);

        PackageStatus::create([
            'name' => 'Delivered',
        ]);

        PackageStatus::create([
            'name' => 'RegisteredForPickUp',
        ]);
    }
}
