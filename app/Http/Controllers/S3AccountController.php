<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class S3AccountController extends Controller
{
    public function save(Request $request)
    {
    	$this->validate($request, [
    		's3_bucket' => 'required',
    		's3_key' => 'required',
    		's3_secret' => 'required',
    	]);

    	Auth::user()->saveS3Credentials($request);

    	return response()->json([
    		'redirect_url' => Auth::user()->onboarding()->inProgress() ? '/home' : '/settings#/bucket',
    	], 200);
    }
}
