<?php

namespace App\Validators;

class CropValidator extends Validator
{
	public function validate()
	{
		$crop = $this->options->crop;

		if ($crop != 0 && ! stripos($crop, 'x')) {
			$this->error('Invalid Crop Dimensions Format. Example: "1920x1080"');
		}
	}
}