<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('subscribed');
    }

    public function showDashboard()
    {
        return view('app.dashboard');
    }

    /**
     * Show the guide for integrating with AWS S3
     */
    public function showS3Guide()
    {
        return view('app.s3_guide');
    }
}
