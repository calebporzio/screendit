<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Screenshot extends Model
{
	use SoftDeletes;

    protected $fillable = [
    	'url',
        'bucket',
        'file',
	    'viewport',
	    'crop',
	    'hide_lightboxes',
    ];

    public function user()
    {
    	return $this->belongsTo('App\User');
    }

    public static function take($rawOptions)
    {
    	return \DB::transaction(function() use ($rawOptions) {
    		// Check, filter & validate.
    		$options = ScreenshotOptions::prepare($rawOptions);

    		// Detecting if cached might go here

    		$model = self::create($options->optionsArray());

    		\Auth::user()->screenshots()->save($model);

    		$filename = $model->filename;

    		$outputPath = storage_path('app/screenshots/' . $filename);
            
    		CommandLine::execute(ScreenshotCommandGenerator::generate($outputPath, $options->formatForCommand()));

    		$model->saveOutputFilename($filename);

    		$model->saveExpires();

    		$model->uploadToS3();

            $model->recordRequest();

    		$model->save();
    		
    		return $model;
    	});
    }

    public function saveOutputFilename($filename)
    {
    	$this->filename = $filename;
    	$this->save();
    }

    public function saveExpires()
    {
    	$this->expires_at = \Carbon\Carbon::now()->addMonth();
    	$this->save();
    }

    public function uploadToS3()
    {
        $key = $this->user->s3_key;
        $secret = $this->user->s3_secret;
        $directory = $this->user->s3_directory;

        if (!$key && !$secret) {
            throw new \Exception('You need to add your S3 credentials');
        }

        \Config::set('filesystems.disks.s3.key', $key);
        \Config::set('filesystems.disks.s3.secret', $secret);

    	\Storage::disk('s3')->put($directory . $this->filename, file_get_contents(storage_path('app/screenshots/' . $this->filename)));

    	$this->removeLocalCopy();
    }

    public function removeLocalCopy()
    {
    	\Storage::disk('local')->delete('screenshots/' . $this->filename);
    }

    public function apiOutput()
    {
    	return [
    		'url' => $this->user->s3_directory . $this->filename,
    		'expires_at' => $this->expires_at,
    		'cached' => $this->cached,
    	];
    }

    public function recordRequest()
    {
        $this->user->incrementRequests();
    }

    public static function deleteExpired()
    {
    	$screenshots = Screenshot::expired()->get();

    	$screenshots->each(function($screenshot) {
    		$screenshot->delete();
    	});
    }

    public function delete()
    {
    	$this->removeFromS3();

    	parent::delete();
    }

    public function removeFromS3()
    {
    	\Storage::delete('screenshots/' . $this->filename);
    }
}
