<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('subscribed');
    }

    /**
     * Show the application dashboard.
     *
     * @return Response
     */
    public function show()
    {
        return view('home');
    }

    /**
     * Show the guide for integrating with AWS S3
     *
     * @return Response
     */
    public function showS3Guide()
    {
        return view('s3_guide');
    }
}
