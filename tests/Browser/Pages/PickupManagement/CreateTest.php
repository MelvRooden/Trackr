<?php

namespace Tests\Browser\Pages\PickupManagement;

use App\Models\Label;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class CreateTest extends DuskTestCase
{
    use DatabaseMigrations;

    public bool $seed = true;

    public function testCreate()
    {
        $label_id = Label::where('package_status_id', 1)
            ->orderBy('carrier_user_id', 'ASC')
            ->first()->id;

        $now = Carbon::now();
        $dateTime = $now->addDays(3);

        $this->browse(function (Browser $browser) use ($dateTime, $label_id) {
            $browser->loginAs('admin@test.com')
                ->visit('/labelManagement')
                ->waitForText('Label management')
                ->press('#pickup_create_modal_button_' . $label_id)
                ->waitForText('Add pickup')
                ->assertSee('Add pickup')
                ->type('pickup_datetime', $dateTime)
                ->type('pickup_address', 'straat 1')
                ->type('pickup_city', 'stadje')
                ->type('pickup_postcode', '1234AB')
                ->press('Create')
                ->assertSee('Label management');
        });
    }
}
