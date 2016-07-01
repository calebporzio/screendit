<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SiteController extends Controller
{
    /**
     * Show the application splash screen.
     *
     * @return Response
     */
    public function showHome()
    {
        return view('site.home');
    }

    /**
     * Show the application documentation.
     *
     * @return Response
     */
    public function showDocs()
    {
        return view('site.docs');
    }

    /**
     * Show the application pricing.
     *
     * @return Response
     */
    public function showPricing()
    {
        return view('site.pricing');
    }
}
