<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class DeleteExpiredScreenshotsTest extends TestCase
{
	use DatabaseMigrations;

    public function test_delete_expired_screenshots()
    {
        $exitCode = Artisan::call('screendit:clear-screenshots');

        $this->assertEquals(0, $exitCode);
    }
}
