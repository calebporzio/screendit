<?php

namespace App\Providers;

use App\User;
use App\Onboarding;
use App\OnboardingSteps;
use App\OnboardingStepManager;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
    		App::singleton(OnboardingSteps::class);

    		// Register onboarding steps.
    		$onboardingSteps = app(OnboardingSteps::class);

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

    public function booted()
    {
    	
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
