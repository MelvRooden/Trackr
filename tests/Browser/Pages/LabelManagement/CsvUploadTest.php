<?php

namespace Tests\Browser\Pages\LabelManagement;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class CsvUploadTest extends DuskTestCase
{
    use DatabaseMigrations;

    public bool $seed = true;

    public function testLabelCsvUpload()
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs('sender@test.com')
                ->visit('/labelManagement/myLabels')
                ->assertSee('Label management')
                ->assertSee('Upload CSV file')
                ->press('Upload CSV file')
                ->waitForText('Upload CSV file')
                ->attach('csvFile', __DIR__ . '/files/TrackrLabels.csv')
                ->press('Create')
                ->waitForText('Label management')
                ->assertSee('Ontvangstraat 2');
        });
    }
}
