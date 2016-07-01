<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ScreenshotTest extends TestCase
{
    use DatabaseMigrations;

    public function setUp()
    {
        parent::setup();

        $user = factory(\App\User::class)->create();

        Auth::login($user);
    }

    /** @test */
    public function get_basic_screenshot()
    {
        $options = [
            'url' => 'http://facebook.com'
        ];

        $this->post('/api/screenshot', $options)
             ->seeStatusCode(200)
             ->seeInDatabase('screenshots', ['url' => $options['url']]);
    }

    public function test_size_of_viewport_screenshot()
    {
        $options = [
            'url' => 'http://google.com',
            'viewport' => '800x600',
        ];

        $response = $this->call('POST', '/api/screenshot', $options);

        $screenshotUrl = $response->original['url'];

        $img = Image::make($screenshotUrl);

        $this->assertEquals(800, $img->width());
    }

    public function test_size_of_crop_screenshot()
    {
        $options = [
            'url' => 'http://google.com',
            'viewport' => '800x600',
            'crop' => '400x400',
        ];

        $response = $this->call('POST', '/api/screenshot', $options);

        $screenshotUrl = $response->original['url'];

        $img = Image::make($screenshotUrl);

        $this->assertEquals(400, $img->width());
        $this->assertEquals(400, $img->height());
    }

    public function test_max_screenshots()
    {
        $options = [
            'url' => 'http://facebook.com'
        ];

        $this->post('/api/screenshot', $options)
             ->seeStatusCode(200)
             ->seeInDatabase('screenshots', ['url' => $options['url']]);
    }
}
