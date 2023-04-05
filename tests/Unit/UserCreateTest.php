<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserCreateTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test the creating of a new user.
     *
     * @return void
     */
    public function test_user_create()
    {
        $this->seed();

//        $user = User::factory()->create();
        $user = new User();

        $user->name = 'Test';
        $user->email = 'unitTest@example.com';
        $user->password = bcrypt('password');
        $user->address = 'Straat 1';
        $user->city = 'Stadje';
        $user->postcode = '1234AB';
        $user->role_id = 4;

        $user->save();

        $assertUserExist = User::where('name', 'Test')
            ->where('email', 'unitTest@example.com')
            ->where('address', 'Straat 1')
            ->where('postcode', '1234AB')
            ->where('city', 'Stadje')
            ->where('role', 4);

        $this->assertTrue($assertUserExist != null);
    }
}
