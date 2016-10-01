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
			'viewport' => '3000x9999',
			'crop' => '22',
			'hide_lightboxes' => 'something'
		], ['Accept' => 'application/json'])->seeJson([
			'url' => ['The url format is invalid.'],
			'file' => ['The file format is invalid.'],
			'viewport' => ['The viewport format is invalid.'],
			'crop' => ['The crop format is invalid.'],
			'hide_lightboxes' => ['The hide lightboxes field must be true or false.'],
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
	}

	public function testScreenshotGetsGenerated()
	{
		$user = $this->getUserWithS3Creds();

		$this->post('/api/screenshot', [
			'url' => 'http://google.com',
			'file' => 'here/test_screenshot.png',
		], ['Accept' => 'application/json'])->seeStatusCode(200);

		// Make sure the screenshot got generated on S3.
		\Config::set('filesystems.disks.s3.key', $user->s3_key);
		\Config::set('filesystems.disks.s3.secret', $user->s3_secret);
		\Config::set('filesystems.disks.s3.bucket', $user->s3_bucket);
		$this->assertTrue(\Storage::disk('s3')->exists('here/test_screenshot.png'));

		// Clean up after test on S3.
		\Storage::disk('s3')->delete('here/test_screenshot.png');
	}

	public function getUserWithS3Creds()
	{
		$user = Auth::user();

		$user->s3_key = env('S3_KEY');
		$user->s3_secret = env('S3_SECRET');
		$user->s3_bucket = env('S3_BUCKET');
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