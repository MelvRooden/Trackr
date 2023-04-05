<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Label;
use Illuminate\Foundation\Testing\RefreshDatabase;

class LabelCreateTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test the creating of a new label.
     *
     * @return void
     */
    public function test_label_create()
    {
        $this->seed();

        $barcode = Label::generateLabelCode();

        $label = new Label();

        $label->barcode_id = $barcode;
        $label->package_status_id = 1;
        $label->carrier_user_id = 1;
        // Sender info
        $label->sender_address = 'Zendstraat 1';
        $label->sender_city = 'Stadje';
        $label->sender_postcode = '4321BA';
        // Receiver info
        $label->receiver_address = 'Ontvangstraat 1';
        $label->receiver_city = 'Stadje';
        $label->receiver_postcode = '1234AB';

        $label->save();

        $assertLabelExist = Label::where('barcode_id', $barcode)
            ->where('package_status_id', 'unitTest@example.com')

            ->where('sender_city', 'Zendstraat 1')
            ->where('sender_city', 'Stadje')
            ->where('sender_city', '4321BA')

            ->where('receiver_address', 'Ontvangstraat 1')
            ->where('receiver_city', 'Stadje')
            ->where('receiver_postcode', '1234AB');

        $this->assertTrue($assertLabelExist != null);
    }
}
