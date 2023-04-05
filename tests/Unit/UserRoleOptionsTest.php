<?php

namespace Tests\Unit;

use App\Models\Role;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserRoleOptionsTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Tests if all user roles are available, no more, no less, with the right names and id's.
     *
     * @return void
     */
    public function test_user_role_options()
    {
        $this->seed();

        $roles = Role::all();

        $this->assertTrue($roles->count() == 4);

        $this->assertTrue($roles->where('name', 'superAdmin')->where('id', 1)->count() == 1);
        $this->assertTrue($roles->where('name', 'sender')->where('id', 2)->count()  == 1);
        $this->assertTrue($roles->where('name', 'packer')->where('id', 3)->count()  == 1);
        $this->assertTrue($roles->where('name', 'receiver')->where('id', 4)->count()  == 1);

        $this->assertTrue(true);
    }
}
