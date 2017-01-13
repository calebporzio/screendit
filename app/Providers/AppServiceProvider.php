<?php

namespace App\Providers;

use App\User;
use Onboard;
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
	    Onboard::addStep('Add Your S3 Credentials')
	    	->cta('Add Them')
	    	->link('/settings#/bucket')
	    	->completeIf(function (User $user) {
	    		return $user->hasAddedS3Creds();
	    	});

	    Onboard::addStep('Create an API Token')
	    	->cta('Create One')
	    	->link('/settings#/api')
	    	->completeIf(function (User $user) {
	    		return $user->hasGeneratedApiToken();
	    	});

	    Onboard::addStep('Generate a Screenshot!')
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
