<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::create([
            'id' => 1,
            'name' => 'superAdmin',
        ]);

        Role::create([
            'id' => 2,
            'name' => 'sender',
        ]);

        Role::create([
            'id' => 3,
            'name' => 'packer',
        ]);

        Role::create([
            'id' => 4,
            'name' => 'receiver',
        ]);
    }
}
