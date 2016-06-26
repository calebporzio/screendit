<?php

namespace App\Validators;

class ViewportValidator extends Validator
{
	public function validate()
	{
		$viewport = $this->options->viewport;

		if (! stripos($viewport, 'x')) {
			$this->error('Invalid Viewport Dimensions Format. Example: "1920x1080"');
		}
	}
}