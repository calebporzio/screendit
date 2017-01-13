<?php

namespace App;

class OnboardingSteps
{
	protected $steps = [];

	public function addStep($title)
	{
		$this->steps[] = $step = new OnboardingStep($title);

		return $step;
	}

	public function steps(User $user)
	{
		return collect($this->steps)->map(function($step) use ($user) {
			return $step->setUser($user);
		});
	}
}