<?php

namespace Tests\Browser\Pages\LabelManagement;

use App\Models\Label;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class SearchFullTextTest extends DuskTestCase
{
    use DatabaseMigrations;

    public bool $seed = true;

    public function testFullTextSearch()
    {
        $label = Label::where('package_status_id', 1)->first();

        $this->browse(function (Browser $browser) use ($label) {
            $browser->loginAs('admin@test.com')
                ->visit('/labelManagement/myLabels')
                ->type('search_param', $label->sender_address)
                ->press('Search')
                ->waitForText('Label management')
                ->assertSee($label->sender_address);
        });
    }


}
