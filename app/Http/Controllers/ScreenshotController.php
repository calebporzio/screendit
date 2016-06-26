<?php

namespace App\Http\Controllers;

use App\Screenshot;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Exceptions\ApiException;
use Symfony\Component\Process\Exception\ProcessFailedException;

class ScreenshotController extends Controller
{
    public function generate(Request $request)
    {
    	try {

    		$screenshot = Screenshot::take($request->all());

    	} catch (ApiException $e) {

    		return response()->json(['error' => $e->getMessage()], $e->getStatusCode());

    	} catch (\Exception $e) {
    		throw $e;
    		return response()->json(['error' => 'An Internal Error has Occurred.'], 500);

    	}  
    	
    	return $screenshot->apiOutput();
    }
}
