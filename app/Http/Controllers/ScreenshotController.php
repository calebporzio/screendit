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
    public function generate(Request $request)
    {
        if (Auth::user()->isOutOfRequests()) {
            return response()->json(['error' => 'You are at your maximum requests for this period.'], 400);
        }

    	try {

    		$screenshot = Screenshot::take($request->all());

    	} catch (\Aws\S3\Exception\S3Exception $e) {

    		return response()->json(['error' => 'Error connecting to S3, check your credentials.'], 400);

    	} catch (\Exception $e) {
    		return response()->json(['error' => 'An Internal Error has Occurred.'], 500);

    	}  
    	
    	return $screenshot->apiOutput();
    }
}
