<?php

use App\ScreenshotOptions;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ScreenshotOptionsTest extends TestCase
{
    public function test_filter()
    {
        $options = [
            'hey' => '1',
            'viewport' => '200',
        ];

        $options = new ScreenshotOptions($options);

        $this->assertTrue(array_key_exists('viewport', $options->optionsArray));
        $this->assertTrue(array_key_exists('hey', $options->optionsArray));

        $filteredArray = $options->filter()->optionsArray;

        $this->assertTrue(array_key_exists('viewport', $filteredArray));
        $this->assertTrue(! array_key_exists('hey', $filteredArray));
    }

    public function test_fill()
    {
        $options = new ScreenshotOptions(['viewport' => '999x999']);

        $this->assertTrue(! isset($options->optionsArray['crop']));

        $options->fill();

        $this->assertTrue($options->optionsArray['viewport'] == '999x999');
        $this->assertTrue(isset($options->optionsArray['crop']));
    }

    /**
    * @expectedException App\Exceptions\ApiException
    */
    public function test_validate_url()
    {
        $options = [
            'url' => 'google.com',
        ];

        ScreenshotOptions::prepare($options);
    }

    /**
    * @expectedException App\Exceptions\ApiException
    */
    public function test_validate_format()
    {
        $options = [
            'url' => 'http://google.com',
            'format' => 'jpsg',
        ];

        ScreenshotOptions::prepare($options);
    }

    /**
    * @expectedException App\Exceptions\ApiException
    */
    public function test_validate_viewport()
    {
        $options = [
            'url' => 'http://google.com',
            'viewport' => '-123',
        ];

        ScreenshotOptions::prepare($options);
    }

    /**
    * @expectedException App\Exceptions\ApiException
    */
    public function test_validate_crop()
    {
        $options = [
            'url' => 'http://google.com',
            'crop' => '-123',
        ];

        ScreenshotOptions::prepare($options);
    }

    public function test_format_for_command()
    {
        //
    }
}
