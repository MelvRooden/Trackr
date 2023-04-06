<?php

namespace Tests\Browser\Pages\UserManagement;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class CreateTest extends DuskTestCase
{
    use DatabaseMigrations;

    public bool $seed = true;

    private function clearCookies()
    {
        foreach (static::$browsers as $browser) {
            $browser->driver->manage()->deleteAllCookies();
        }
    }

    public function testUserCreate()
    {
        $email = 'createUser@dusk.com';

        $this->browse(function (Browser $browser) use ($email) {
            $browser->loginAs('admin@test.com')
                ->visit('/userManagement')
                ->press('Add user')
                ->waitForText('New user')
                ->type('name', 'createUserDusk')
                ->type('email', $email)
                ->type('password', 'password')
                ->type('address', 'address 1')
                ->type('city', 'city')
                ->type('postcode', '1234AB')
                ->select('role_id', 4)
                ->press('Create')
                ->assertPathIs('/userManagement')
                ->assertSee($email);
        });

        $this->clearCookies();
    }
}
