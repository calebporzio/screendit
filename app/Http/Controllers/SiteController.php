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
    public function showMarketingPage()
    {
        return view('site.marketing');
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
