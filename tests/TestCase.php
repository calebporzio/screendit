<?php

class TestCase extends Illuminate\Foundation\Testing\TestCase
{
    /**
     * The base URL to use while testing the application.
     *
     * @var string
     */
    protected $baseUrl = 'http://localhost';

    /**
     * Creates the application.
     *
     * @return \Illuminate\Foundation\Application
     */
    public function createApplication()
    {
        $app = require __DIR__.'/../bootstrap/app.php';

        $app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

        return $app;
    }

    public function generateTrialUser()
    {
    	$user = factory(\App\User::class)->states('on-trial')->create();

    	Auth::login($user);

    	return $user;
    }

    public function generateUser()
    {
    	$user = factory(\App\User::class)->create();

    	$user->subscriptions()->create([
    		'name' => 'default',
    		'stripe_id' => 'test_stripe_id',
    		'stripe_plan' => 'standard-monthly',
    		'quantity' => 1,
    	]);

    	$user->s3_key = env('S3_KEY');
		$user->s3_secret = env('S3_SECRET');
		$user->s3_bucket = env('S3_BUCKET');
		$user->save();

    	Auth::login($user);

    	return $user;
    }
}
