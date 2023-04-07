<?php

namespace Tests\Browser\Pages\LabelManagement;

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
                ->visit('/labelManagement/myLabels')
                ->assertAuthenticated()
                ->assertSee('Label management');
        });

        $this->clearCookies();
    }

    public function testSenderViewRights()
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs('sender@test.com')
                ->visit('/labelManagement/myLabels')
                ->assertAuthenticated()
                ->assertSee('Label management');
        });

        $this->clearCookies();
    }

    public function testPackerViewRights()
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs('postnl@test.com')
                ->visit('/labelManagement/myLabels')
                ->assertAuthenticated()
                ->assertSee('Label management');
        });

        $this->clearCookies();
    }

    public function testReceiverViewRights()
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs('receiver@test.com')
                ->visit('/labelManagement/myLabels')
                ->assertAuthenticated()
                ->assertSee('Label management');
        });

        $this->clearCookies();
    }

    public function testNoAuthNoViewRights()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/userManagement/myLabels')
                ->assertSee('403');
        });

        $this->clearCookies();
    }
}
