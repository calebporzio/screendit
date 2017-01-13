<?php

use Illuminate\Foundation\Testing\DatabaseMigrations;

class GenerateScreenshotTest extends TestCase
{
	use DatabaseMigrations;

	public function testMissingParameters()
	{
		$this->generateUser();
		
		$this->post('/api/screenshot', [
			// Purposely missing required params
		], ['Accept' => 'application/json'])->seeJson([
			'url' => ['The url field is required.'],
			'file' => ['The file field is required.'],
		]);
	}

	public function testInvalidInput()
	{
		$this->generateUser();

		$this->post('/api/screenshot', [
			// Invalid Url
			'url' => 'testurl.com',
			'file' => 'somepic.xml',
			'viewport' => '3000x9999',
			'crop' => '54',
			'thumbnail' => '22',
			'hide_lightboxes' => 'something'
		], ['Accept' => 'application/json'])->seeJson([
			'url' => ['The url format is invalid.'],
			'file' => ['The file format is invalid.'],
			'viewport' => ['The viewport format is invalid.'],
			'crop' => ['The crop format is invalid.'],
			'thumbnail' => ['The thumbnail format is invalid.'],
			'hide_lightboxes' => ['The hide lightboxes field must be true or false.'],
		]);
	}

	public function testUserIsOutOfRequestsForTheMonth()
	{
		$user = $this->generateUser();
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
		$user = $this->generateUser();

		$this->post('/api/screenshot', [
			'url' => 'http://google.com',
			'file' => 'here/test_screenshot.png',
			'viewport' => '1920x1080',
			'crop' => '1920x1080',
			'thumbnail' => '600x450',
		], ['Accept' => 'application/json'])->seeStatusCode(200);

		// Make sure the screenshot got generated on S3.
		\Config::set('filesystems.disks.s3.key', $user->s3_key);
		\Config::set('filesystems.disks.s3.secret', $user->s3_secret);
		\Config::set('filesystems.disks.s3.bucket', $user->s3_bucket);
		$this->assertTrue(\Storage::disk('s3')->exists('here/test_screenshot.png'));

		// Clean up after test on S3.
		\Storage::disk('s3')->delete('here/test_screenshot.png');
	}
}