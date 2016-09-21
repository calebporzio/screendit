<?php

use Carbon\Carbon;
use App\Screenshot;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ScreenshotTest extends TestCase
{
	use DatabaseMigrations;