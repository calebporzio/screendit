<?php

namespace App\Http\Controllers;

use App\Screenshot;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Exceptions\ApiException;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\Process\Exception\ProcessFailedException;

class ScreenshotController extends Controller
{
    public function __construct()
    {
        $this->middleware('subscribed');    
    }

    public function generate(Request $request)
    {
        $this->validate($request, [
            'url' => 'required|url', 
            'file' => ['required', 'regex:/(.jpg)|(.png)$/'],
            'viewport' => ['regex:/^(([0-9]{1,3}|[0-1][0-9]{1,3})x([0-9]{1,3}|[0-1][0-9]{1,3}))$/'],
            'crop' => ['regex:/^(([0-9]{1,3}|[0-1][0-9]{1,3})x([0-9]{1,3}|[0-1][0-9]{1,3}))$/'],
            'thumbnail' => ['regex:/^(([0-9]{1,3}|[0-1][0-9]{1,3})x([0-9]{1,3}|[0-1][0-9]{1,3}))$/'],
            'hide_lightboxes' => 'boolean',
        ]);

        if (Auth::user()->isOutOfRequests()) {
            return response()->json(['error' => 'You are at your maximum requests for this period.'], 400);
        }

    	try {

    		$screenshot = Screenshot::take($request->all());

    	} catch(\App\Exceptions\MissingS3CredentialsException $e) {
    		// User hasn't inputted S3 credentials yet.
            return response()->json($e->getMessage(), 400);
        } catch (\Aws\S3\Exception\S3Exception $e) {
        	// Any S3 Connection Issue.
    		return response()->json(['error' => 'Error connecting to S3, check your credentials.'], 400);
    	} catch (\Exception $e) {
    		// Any other issue, give them a generic response to not reveal
    		// anything unintended. Also, log it for reference.
            \Log::log('error', $e);
    		return response()->json(['error' => 'An Internal Error has Occurred.'], 500);
    	}  
    	
    	return $screenshot->apiOutput();
    }
}
