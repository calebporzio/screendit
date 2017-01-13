<?php

use Laravel\Spark\Token;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class OnboardNewUser extends TestCase
{
	use DatabaseMigrations;

	/** @test */
	public function sees_onboarding_options_but_not_counter() {
		$this->generateTrialUser();

		// Can see the onboarding steps.
		$this->visit('/home')
			 ->see('Add Your S3 Credentials')
			 ->see('Create an API Token')
			 ->see('Generate a Screenshot!')
			 ->dontSeeElement('.progress-bar');
	}
}
