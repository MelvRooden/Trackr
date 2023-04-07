<?php

namespace Tests\Browser\Pages\PickupManagement;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class IndexTest extends DuskTestCase
{
    use DatabaseMigrations;

    public bool $seed = true;

    private function clearCookies()
    {
        foreach (static::$browsers as $browser) {
            $browser->driver->manage()->deleteAllCookies();
        }
    }

    public function testAdminViewRights()
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs('admin@test.com')
                ->visit('/pickupManagement/pickups')
                ->assertAuthenticated()
                ->assertSee('Pickup management');
        });

        $this->clearCookies();
    }

    public function testSenderNoViewRights()
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs('sender@test.com')
                ->visit('/pickupManagement/pickups')
                ->assertAuthenticated()
                ->assertSee('Pickup management');
        });

        $this->clearCookies();
    }

    public function testPackerNoViewRights()
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs('postnl@test.com')
                ->visit('/pickupManagement/pickups')
                ->assertAuthenticated()
                ->assertSee('Pickup management');
        });

        $this->clearCookies();
    }

    public function testReceiverNoViewRights()
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs('receiver@test.com')
                ->visit('/pickupManagement/pickups')
                ->assertAuthenticated()
                ->assertSee('403');
        });

        $this->clearCookies();
    }

    public function testNoAuthNoViewRights()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/pickupManagement/pickups')
                ->assertSee('403');
        });

        $this->clearCookies();
    }
}
