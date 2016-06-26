<?php

use App\ScreenshotOptions;
use App\ScreenshotCommandGenerator;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ScreenshotCommandGeneratorTest extends TestCase
{
    protected $outputPath = './image.png';

    protected $options = [
        'url' => 'http://google.com',
        'viewport_width' => '1080',
        'viewport_height' => '300',
        'output_width' => '1080',
        'output_height' => '0',
        'hide_lightboxes' => '0',
    ];

    protected $generator;

    public function setUp()
    {
        parent::setUp();
        
        $this->generator = new ScreenshotCommandGenerator($this->outputPath, $this->options);
    }

    public function test_start()
    {
        $this->generator->start();

        $this->assertEquals('/usr/local/bin/phantomjs /Users/calebporzio/Documents/Code/homestead/screendit/rasterize.js', $this->generator->getCommand());
    }

    public function test_add_url()
    {
        $this->generator->addUrl();

        $this->assertEquals(' ' . $this->options['url'], $this->generator->getCommand());   
    }

    public function test_add_output_path()
    {
        $this->generator->addOutputPath();

        $this->assertEquals(' ' . $this->outputPath, $this->generator->getCommand());   
    }

    public function test_add_options()
    {
        $this->generator->addOptions();

        $optionsString = '1080 300 1080 0 0';

        $this->assertEquals(' ' . $optionsString, $this->generator->getCommand());   
    }

    public function test_generate()
    {
        $command = ScreenshotCommandGenerator::generate($this->outputPath, $this->options);

        $this->assertEquals('/usr/local/bin/phantomjs /Users/calebporzio/Documents/Code/homestead/screendit/rasterize.js ' . $this->options['url'] . ' ' . $this->outputPath . ' 1080 300 1080 0 0', $command);
    }
}
