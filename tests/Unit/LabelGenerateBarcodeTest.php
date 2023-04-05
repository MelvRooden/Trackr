<?php

namespace Tests\Unit;

use App\Models\Label;
use Illuminate\Support\Str;
use PHPUnit\Framework\TestCase;

class LabelGenerateBarcodeTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_generate_label_barcode()
    {
        for ($i = 0; $i < 10; $i++)
        {
            $barcode = Label::generateLabelCode();

            $this->assertTrue(Str::length($barcode) == 28);
        }
    }
}
