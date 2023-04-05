<?php

namespace Tests\Unit;

use App\Models\PackageStatus;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class LabelStatusOptionsTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Tests if all label package statuses are available, no more, no less, with the right names and id's.
     *
     * @return void
     */
    public function test_label_status_options()
    {
        $this->seed();

        $statuses = PackageStatus::all();

        $this->assertTrue($statuses->count() == 5);

        $this->assertTrue($statuses->where('name', 'registered')->where('id', 1)->count() == 1);
        $this->assertTrue($statuses->where('name', 'sortingCenter')->where('id', 2)->count()  == 1);
        $this->assertTrue($statuses->where('name', 'onTheWay')->where('id', 3)->count()  == 1);
        $this->assertTrue($statuses->where('name', 'delivered')->where('id', 4)->count()  == 1);
        $this->assertTrue($statuses->where('name', 'registeredForPickUp')->where('id', 5)->count()  == 1);
    }
}
