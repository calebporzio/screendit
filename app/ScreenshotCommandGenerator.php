<?php

namespace App;

class ScreenshotCommandGenerator
{
	protected $path;

	protected $options;

	protected $command;

	public function __construct($path, $options)
	{
		$this->path = $path;
		$this->options = $options;
	}

	public static function generate($path, $options)
	{
		return (new self($path, $options))
			->start()
			->addUrl()
			->addOutputPath()
			->addOptions()
			->optionallyAddThumbnail()
			->getCommand();
	}

	public function start()
	{
		$this->command = '/usr/local/bin/phantomjs ' . base_path('rasterize.js');

		return $this;
	}

	public function addUrl()
	{
		$this->command .= ' ' . $this->options['url'];

		return $this;
	}

	public function addOutputPath()
	{
		$this->command .= ' ' . $this->path;

		return $this;
	}

	public function addOptions()
	{
		$this->command .= ' ' . $this->options['viewport_width'];
		$this->command .= ' ' . $this->options['viewport_height'];
		$this->command .= ' ' . $this->options['crop_width'];
		$this->command .= ' ' . $this->options['crop_height'];
		$this->command .= ' ' . $this->options['hide_lightboxes'];

		return $this;
	}

	public function optionallyAddThumbnail()
	{
		if (! $this->options['thumbnail_width'] && ! $this->options['thumbnail_height']) {
			return $this;
		}

		$thumbSize = $this->options['thumbnail_width'] . 'x' . $this->options['thumbnail_height'];

		$this->command .= "&& convert $this->path -thumbnail $thumbSize^ -gravity north -extent $thumbSize $this->path";

		return $this;
	}

	public function getCommand()
	{
		return $this->command;
	}
}