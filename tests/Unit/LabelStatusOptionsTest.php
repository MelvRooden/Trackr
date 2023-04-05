<?php

namespace Tests\Unit;

use App\Models\PackageStatus;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class LabelStatusOptionsTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_label_status_options()
    {
        $statuses = PackageStatus::all();

        $this->assertTrue($statuses->count() == 5);

        $this->assertTrue($statuses->where('name', 'registered').$this->count() == 1);
        $this->assertTrue($statuses->where('name', 'sortingCenter').$this->count()  == 1);
        $this->assertTrue($statuses->where('name', 'onTheWay').$this->count()  == 1);
        $this->assertTrue($statuses->where('name', 'delivered').$this->count()  == 1);
        $this->assertTrue($statuses->where('name', 'registeredForPickUp').$this->count()  == 1);
    }
}
