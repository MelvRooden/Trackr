<?php

namespace Tests\Browser\Pages\LabelManagement;

use App\Models\Label;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class FindByBarcodeTest extends DuskTestCase
{
    use DatabaseMigrations;

    public bool $seed = true;

    public function testGetStatusByBarcode()
    {
        $label = Label::all()->first();

        $this->browse(function (Browser $browser) use ($label) {
            $browser->visit('/labelManagement/barCodeSearch')
                ->assertSee('Package status')
                ->press('Retrieve package info')
                ->waitForText('Find status by barcode')
                ->type('barcode_id', $label->barcode_id)
                ->press('Retrieve package info')
                ->waitForText('Retrieve package info')
                ->assertSee($label->sender_address);
        });
    }
}
