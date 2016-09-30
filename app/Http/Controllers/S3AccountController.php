<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class S3AccountController extends Controller
{
    public function save(Request $request)
    {
    	Auth::user()->saveS3Credentials($request);

    	return 'success';
    }
}
