<?php

use Illuminate\Foundation\Testing\DatabaseMigrations;

class AddS3CredsTest extends TestCase
{
	use DatabaseMigrations;

	public function testSaveUsersS3Creds()
	{
		$this->generateUser();

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
}