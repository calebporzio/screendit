<?php

namespace App;

class ScreenshotOptions
{
	public $defaults = [
		'url' => '',
		'file' => '',
		'viewport' => '1366x768',
		'crop' => '0',
		'thumbnail' => '0',
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
					->setOptionDefaults()
					->filterOutExtraInput();
	}

	public function setOptionDefaults()
	{
		$this->optionsArray = array_merge($this->defaults, $this->optionsArray);

		return $this;
	}

	public function filterOutExtraInput()
	{
		$this->optionsArray = array_intersect_key($this->optionsArray, $this->defaults);

		return $this;
	}

	public function toArray()
	{
		return $this->optionsArray;
	}

	public function getExtension()
	{
		preg_match('/(\.)([^.]+)$/', $this->file, $match);

		return $match[2];
	}

	public function formatForCommand()
	{
		return [
			'url' => $this->optionsArray['url'],
			'viewport_width' => (int) substr($this->optionsArray['viewport'], 0, strpos($this->optionsArray['viewport'], 'x')),
			'viewport_height' => (int) substr($this->optionsArray['viewport'], strpos($this->optionsArray['viewport'], 'x')+1),
			'crop_width' => (int) substr($this->optionsArray['crop'], 0, strpos($this->optionsArray['crop'], 'x')) ?: 0,
			'crop_height' => (int) substr($this->optionsArray['crop'], strpos($this->optionsArray['crop'], 'x')+1) ?: 0,
			'thumbnail_width' => (int) substr($this->optionsArray['thumbnail'], 0, strpos($this->optionsArray['thumbnail'], 'x')) ?: 0,
			'thumbnail_height' => (int) substr($this->optionsArray['thumbnail'], strpos($this->optionsArray['thumbnail'], 'x')+1) ?: 0,
			'hide_lightboxes' => (int) (bool) $this->optionsArray['hide_lightboxes'],
		];
	}

	public function __get($key)
	{
		return $this->optionsArray[$key];
	}
}