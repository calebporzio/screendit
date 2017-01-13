<?php

namespace App;

use App\User;
use App\OnboardingSteps;

class OnboardingManager {
	public $steps;

	public function __construct(User $user, OnboardingSteps $onboardingSteps)
	{
		$this->steps = $onboardingSteps->steps($user);
	}

	public function steps()
	{
		return $this->steps;
	}

	public function inProgress()
	{
		return ! $this->finished();
	}

	public function finished()
	{
		return collect($this->steps)->filter(function ($step) {
			// Leave only incomplete steps.
			return $step->incomplete();
		})
		// Report onboarding is finished if no incomplete steps remain.
		->isEmpty();
	}
}