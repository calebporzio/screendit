<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PeriodHistory extends Model
{
    protected $table = 'period_history';

    public function user()
    {
    	return $this->belongsTo('App\User');
    }
}
