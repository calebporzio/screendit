<?php

namespace App;

class ScreenshotOptions
{
	public $defaults = [
		'url' => '',
		'viewport' => '1480x1037',
		'crop' => '0',
		'cached' => false,
		'format' => 'jpg',
		'hide_lightboxes' => false,
	];

	public $optionsArray;

	public function __construct($inputOptions)
	{
		$this->optionsArray = $inputOptions;
	}

	public static function prepare($inputOptions)
	{
		return (new self($inputOptions))
					->fill()
					->filter()
					->validate();
	}

	public function filter()
	{
		$this->optionsArray = array_intersect_key($this->optionsArray, $this->defaults);

		return $this;
	}

	public function fill()
	{
		$this->optionsArray = array_merge($this->defaults, $this->optionsArray);

		return $this;
	}

	public function validate()
	{
		$validators = [
			\App\Validators\UrlValidator::class,
			\App\Validators\ViewportValidator::class,
			\App\Validators\CropValidator::class,
			\App\Validators\CacheValidator::class,
			\App\Validators\FormatValidator::class,
			\App\Validators\HideLightboxesValidator::class,
		];

		foreach ($validators as $validator) {
			(new $validator($this))->validate();
		}

		return $this;
	}

	public function optionsArray()
	{
		return $this->optionsArray;
	}

	public function formatForCommand()
	{
		return [
			'url' => $this->optionsArray['url'],
			'viewport_width' => (int) substr($this->optionsArray['viewport'], 0, strpos($this->optionsArray['viewport'], 'x')),
			'viewport_height' => (int) substr($this->optionsArray['viewport'], strpos($this->optionsArray['viewport'], 'x')+1),
			'output_width' => (int) substr($this->optionsArray['crop'], 0, strpos($this->optionsArray['crop'], 'x')) ?: 0,
			'output_height' => (int) substr($this->optionsArray['crop'], strpos($this->optionsArray['crop'], 'x')+1) ?: 0,
			'hide_lightboxes' => (int) (bool) $this->optionsArray['hide_lightboxes'],
		];
	}

	public function __get($key)
	{
		return $this->optionsArray[$key];
	}
}