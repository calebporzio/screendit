<?php

use Carbon\Carbon;
use App\Screenshot;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ScreenshotTest extends TestCase
{
	use DatabaseMigrations;

    public function test_delete_expired_screenshots()
    {
    	Storage::shouldReceive('delete');

    	$screenshots = factory(Screenshot::class, 10)->create(['expires_at' => Carbon::now()->subDay()]);

    	$this->assertEquals(10, Screenshot::all()->count());

        Screenshot::deleteExpired();

        $this->assertEquals(0, Screenshot::all()->count());
    }
}
