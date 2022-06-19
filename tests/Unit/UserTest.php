<?php

namespace Tests\Unit;

use App\Models\User;
use PHPUnit\Framework\TestCase;

class UserTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_create_user()
    {
        $user = new User();
        $user->name = 'Test';
        $user->email = 'test@example.com';
        $user->password = bcrypt('test123');
        $user->address = '123Street';
        $user->zipcode = '5432 BB';
        $user->city = 'San Francisco';
        $user->role = 4;

        $user->save();
        $assertUserExist = User::where('name', 'Test')->where('email', 'test@example.com');

        $this->assertTrue($assertUserExist != null);
    }
}
