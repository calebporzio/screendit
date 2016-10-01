<?php

use Illuminate\Foundation\Testing\DatabaseMigrations;

class AddS3CredsTest extends TestCase
{
	use DatabaseMigrations;

	public function setUp()
	{
		parent::setUp();

		$this->setUpUser();
	}

	public function testSaveUsersS3Creds()
	{
		$this->post('/api/s3-account', [
			's3_key' => 12345,
			's3_secret' => 12345,
			's3_bucket' => 'test',
		])->seeStatusCode(200)->seeInDatabase('users', [
			's3_key' => '12345',
			's3_secret' => '12345',
			's3_bucket' => 'test',
		]);
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