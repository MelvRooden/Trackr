<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
            'email' => 'superadmin@gmail.com',
            'password' => Hash::make('password'),
            'address' => 'straatje 1',
            'city' => 'stadje',
            'postcode' => '4135GM',
            'role_id' => 1
        ]);

        // Sender
        User::create([
            'name' => 'Sender',
            'email' => 'sender@gmail.com',
            'password' => Hash::make('password'),
            'address' => 'straatje 2',
            'city' => 'stadje',
            'postcode' => '4135GM',
            'role_id' => 2
        ]);
        User::create([
            'name' => 'ShopX',
            'email' => 'ShopX@gmail.com',
            'password' => Hash::make('password'),
            'address' => 'straatje 2',
            'city' => 'stadje',
            'postcode' => '4135GM',
            'role_id' => 2
        ]);

        //Packer
        User::create([
            'name' => 'Packer',
            'email' => 'packer@gmail.com',
            'password' => Hash::make('password'),
            'address' => 'straatje 3',
            'city' => 'stadje',
            'postcode' => '4135GM',
            'role_id' => 3
        ]);
        User::create([
            'name' => 'PostPackX',
            'email' => 'PostPackX@gmail.com',
            'password' => Hash::make('password'),
            'address' => 'straatje 3',
            'city' => 'stadje',
            'postcode' => '4135GM',
            'role_id' => 3
        ]);
        User::create([
            'name' => 'StackSend',
            'email' => 'StackSend@gmail.com',
            'password' => Hash::make('password'),
            'address' => 'straatje 3',
            'city' => 'stadje',
            'postcode' => '4135GM',
            'role_id' => 3
        ]);

        // receiver
        User::create([
            'name' => 'receiver',
            'email' => 'receiver@gmail.com',
            'password' => Hash::make('password'),
            'address' => 'straatje 4',
            'city' => 'stadje',
            'postcode' => '4135GM',
            'role_id' => 4
        ]);
        User::create([
            'name' => 'receiverO',
            'email' => 'receiverO@gmail.com',
            'password' => Hash::make('password'),
            'address' => 'straatje 4',
            'city' => 'stadje',
            'postcode' => '4135GM',
            'role_id' => 4
        ]);

        User::factory()->count(10)->create();
    }
}
