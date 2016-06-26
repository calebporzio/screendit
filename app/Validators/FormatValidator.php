<?php

namespace App\Validators;

class FormatValidator extends Validator
{
	public function validate()
	{
		$supportedFormats = [
			'pdf',
			'png',
			'jpeg',
			'jpg',
			'bmp',
			'ppm',
			'gif',
		];

		if (! in_array(strtolower($this->options->format), $supportedFormats)) {
			$this->error('File Format Not Supported');
		}
	}
}