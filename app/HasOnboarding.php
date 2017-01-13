<?php

namespace App;

use Carbon\Carbon;
use App\OnboardingManager;
use Illuminate\Support\Facades\App;

trait HasOnboarding
{
	public function onboarding()
	{
		return app(OnboardingManager::class, [$this]);
	}

	public function hasAddedS3Creds()
	{
		return $this->s3_bucket && $this->s3_key && $this->s3_secret;
	}

	public function hasGeneratedApiToken()
	{
	    return $this->tokens()->count() > 0;
	}

	public function hasGeneratedAScreenshot()
	{
	    $monthsSinceSignUp = Carbon::now()->diff(new Carbon($this->created_at))->m;
	    
	    return $this->requests_this_period > 0 && $monthsSinceSignUp < 1;
	}
}