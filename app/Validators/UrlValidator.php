<?php

namespace App\Validators;

class UrlValidator extends Validator
{
	public function validate()
	{
		if ($this->options->url == '') {
			$this->error('Url Field Required');
		}
		
		if (filter_var($this->options->url, FILTER_VALIDATE_URL) === false) {
			$this->error('Invalid Url');
		}
	}
}