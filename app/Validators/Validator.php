<?php

namespace App\Validators;

use App\ScreenshotOptions;
use App\Exceptions\ApiException;

abstract class Validator
{
	protected $options;

	public function __construct(ScreenshotOptions $options)
	{
		$this->options = $options;
	}

	public function error($message, $statusCode = '400')
	{
		throw new ApiException($message, $statusCode);
	}
}