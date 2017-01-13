<?php

namespace App;

use Carbon\Carbon;
use Calebporzio\Onboard\GetsOnboarded;
use Laravel\Spark\User as SparkUser;

class User extends SparkUser
{
    use GetsOnboarded;
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'authy_id',
        'country_code',
        'phone',
        'card_brand',
        'card_last_four',
        'card_country',
        'billing_address',
        'billing_address_line_2',
        'billing_city',
        'billing_zip',
        'billing_country',
        'extra_billing_information',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'trial_ends_at' => 'date',
        'uses_two_factor_auth' => 'boolean',
    ];

    public function histories()
    {
        return $this->hasMany('App\PeriodHistory');
    }

    public function screenshots()
    {
        return $this->hasMany('App\Screenshot');
    }

    public function incrementRequests()
    {
        $this->requests_this_period++;

        $this->save();
    }

    public function periodIsOver()
    {
        return $this->period_start_date < (new \Carbon\Carbon('1 Month Ago'));
    }

    public function setPeriodStart()
    {
        $this->period_start_date = \Carbon\Carbon::now();
        $this->requests_this_period = 0;

        $this->save();
    }

    public function isOutOfRequests()
    {
        // Limit trial memberships to 25 requests.
        $limit = $this->sparkPlan() ? $this->sparkPlan()->attribute('monthly_limit') : 25;

        return $this->requests_this_period >= $limit;
    }

    public function saveS3Credentials($request)
    {
        $this->s3_bucket = $request->s3_bucket;
        $this->s3_key = $request->s3_key;
        $this->s3_secret = $request->s3_secret;

        $this->save();
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

    public function toArray()
    {
        return array_merge(parent::toArray(), [
            's3_secret' => str_repeat("*", strlen($this->s3_secret)),
        ]);
    }
}
