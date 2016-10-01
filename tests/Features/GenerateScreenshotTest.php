<?php

use Illuminate\Foundation\Testing\DatabaseMigrations;

class GenerateScreenshotTest extends TestCase
{
	use DatabaseMigrations;

	public function setUp()
	{
		parent::setUp();

		$this->setUpUser();
	}

	public function testMissingParameters()
	{
		$this->post('/api/screenshot', [
			// Purposely missing required params
		], ['Accept' => 'application/json'])->seeJson([
			'url' => ['The url field is required.'],
			'file' => ['The file field is required.'],
		]);
	}

	public function testInvalidInput()
	{
		$this->post('/api/screenshot', [
			// Invalid Url
			'url' => 'testurl.com',
			'file' => 'somepic.xml',
		], ['Accept' => 'application/json'])->seeJson([
			'url' => ['The url format is invalid.'],
			'file' => ['The file format is invalid.'],
		]);
	}

	public function testUserIsOutOfRequestsForTheMonth()
	{
		$user = Auth::user();
		$user->requests_this_period = 15000;
		$user->save();

		$this->post('/api/screenshot', [
			'url' => 'http://google.com',
			'file' => 'test_screenshot.png',
		], ['Accept' => 'application/json'])->seeJson([
			'error' => 'You are at your maximum requests for this period.',
		]);

		// check s3 if it exists
	}

	public function testScreenshotGetsGenerated()
	{
		$user = $this->getUserWithS3Creds();

		$this->post('/api/screenshot', [
			'url' => 'http://google.com',
			'file' => 'test_screenshot.png',
		], ['Accept' => 'application/json'])->dump()->seeStatusCode(200);

		// check s3 if it exists
	}

	public function getUserWithS3Creds()
	{
		$user = Auth::user();

		$user->s3_key = env('S3_KEY');
		$user->s3_secret = env('S3_SECRET');
		$user->save();

		return $user;
	}

	protected function setUpUser()
	{
		$user = factory(\App\User::class)->create();

		$user->subscriptions()->create([
			'name' => 'default',
			'stripe_id' => 'test_stripe_id',
			'stripe_plan' => 'standard-monthly',
			'quantity' => 1,
		]);

		Auth::login($user);

		return $user;
	}
}