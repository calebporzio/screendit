<?php

namespace App\Providers;

use App\User;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;
use Calebporzio\Onboard\OnboardingSteps;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
		// Register onboarding steps.
		$onboardingSteps = $this->app->make(OnboardingSteps::class);

	    $onboardingSteps->addStep('Add Your S3 Credentials')
	    	->cta('Add Them')
	    	->link('/settings#/bucket')
	    	->completeIf(function (User $user) {
	    		return $user->hasAddedS3Creds();
	    	});

	    $onboardingSteps->addStep('Create an API Token')
	    	->cta('Create One')
	    	->link('/settings#/api')
	    	->completeIf(function (User $user) {
	    		return $user->hasGeneratedApiToken();
	    	});

	    $onboardingSteps->addStep('Generate a Screenshot!')
	    	->cta('See How')
	    	->link('/docs')
	    	->completeIf(function (User $user) {
	    		return $user->hasGeneratedAScreenshot();
	    	});
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
