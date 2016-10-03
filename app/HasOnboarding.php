<?php

namespace App;

use Carbon\Carbon;

trait HasOnboarding
{
	protected $totalSteps = 3;

	public function isOnboarding()
	{
		return $this->currentStep() <= $this->totalSteps;
	}

	public function currentStep()
	{
		// Nasty conditional... I know... sorry...
		if (!$this->hasAddedS3Creds() && !$this->hasGeneratedApiToken() && !$this->hasGeneratedAScreenshot()) {
			return 0;
		} elseif ($this->hasAddedS3Creds() && $this->hasGeneratedApiToken() && $this->hasGeneratedAScreenshot()) {
			return 3;
		} elseif ($this->hasAddedS3Creds() && $this->hasGeneratedApiToken()) {
			return 2;
		} else if ($this->hasAddedS3Creds()) {
			return 1;
		} else {
			return 3;
		}
	}

	protected function hasAddedS3Creds()
	{
		return $this->s3_bucket && $this->s3_key && $this->s3_secret;
	}

	protected function hasGeneratedApiToken()
	{
	    return $this->tokens()->count() > 0;
	}

	protected function hasGeneratedAScreenshot()
	{
	    $monthsSinceSignUp = Carbon::now()->diff(new Carbon($this->created_at))->m;
	    
	    return $this->requests_this_period > 0 && $monthsSinceSignUp < 1;
	}
}