<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Super Admin
        User::create([
            'name' => 'Super Admin',
            'email' => 'admin@test.com',
            'password' => Hash::make('password'),
            'address' => 'straatje 1',
            'city' => 'stadje',
            'postcode' => '4135GM',
            'role_id' => 1
        ]);

        // Sender
        User::create([
            'name' => 'Sender',
            'email' => 'sender@test.com',
            'password' => Hash::make('password'),
            'address' => 'straatje 2',
            'city' => 'stadje',
            'postcode' => '4135GM',
            'role_id' => 2
        ]);
        User::create([
            'name' => 'ShopX',
            'email' => 'ShopX@test.com',
            'password' => Hash::make('password'),
            'address' => 'straatje 2',
            'city' => 'stadje',
            'postcode' => '4135GM',
            'role_id' => 2
        ]);

        //Packer
        User::create([
            'name' => 'PostNL',
            'email' => 'postnl@test.com',
            'password' => Hash::make('password'),
            'address' => 'Bazeldijk 2',
            'city' => 'Hoogblokland',
            'postcode' => '4221XV',
            'role_id' => 3
        ]);
        User::create([
            'name' => 'DHL',
            'email' => 'dhl@test.com',
            'password' => Hash::make('password'),
            'address' => 'Reactorweg 25',
            'city' => 'Utrecht',
            'postcode' => '3542AD',
            'role_id' => 3
        ]);
        User::create([
            'name' => 'UPS',
            'email' => 'ups@test.com',
            'password' => Hash::make('password'),
            'address' => 'Achtseweg Noord 14',
            'city' => 'Eindhoven',
            'postcode' => '5651GG',
            'role_id' => 3
        ]);

        // receiver
        User::create([
            'name' => 'receiver',
            'email' => 'receiver@test.com',
            'password' => Hash::make('password'),
            'address' => 'straatje 4',
            'city' => 'stadje',
            'postcode' => '4135GM',
            'role_id' => 4
        ]);
        User::create([
            'name' => 'Willy',
            'email' => 'WillyJhon@test.com',
            'password' => Hash::make('password'),
            'address' => 'straatje 4',
            'city' => 'stadje',
            'postcode' => '4135GM',
            'role_id' => 4
        ]);

        User::factory()->count(10)->create(['role_id' => 4]);
    }
}
