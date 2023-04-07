<?php

namespace Tests\Browser\Pages\Review;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class IndexTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function testLeaveReview()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/review')
                ->assertSee('Leave a review')
                ->type('name', 'duskname')
                ->type('email', 'duskname@test.com')
                ->type('name', 'duskname')
                ->type('comment', 'A super call review!')
                ->select('Rating', 5)
                ->press('Leave a review')
                ->assertPathIs('/review')
                ->assertSee('Leave a review');
        });
    }
}
