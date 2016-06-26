<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Screenshot extends Model
{
	use SoftDeletes;

    protected $fillable = [
    	'url',
	    'viewport',
	    'crop',
	    'hide_lightboxes',
	    'cached',
	    'format',
    ];

    public function user()
    {
    	return $this->belongsTo('App\User');
    }

    public function scopeExpired($query)
    {
    	return $query->where('expires_at', '<', \Carbon\Carbon::now());
    }

    public static function take($rawOptions)
    {
    	return \DB::transaction(function() use ($rawOptions) {
    		// Check, filter & validate.
    		$options = ScreenshotOptions::prepare($rawOptions);

    		// Detecting if cached might go here

    		$model = self::create($options->optionsArray());

    		\Auth::user()->screenshots()->save($model);

    		$filename = $model->generateFilename();

    		$outputPath = storage_path('app/screenshots/' . $filename);
            
    		CommandLine::execute(ScreenshotCommandGenerator::generate($outputPath, $options->formatForCommand()));

    		$model->saveOutputFilename($filename);

    		$model->saveExpires();

    		$model->uploadToS3();

    		$model->save();
    		
    		return $model;
    	});
    }

    public function generateFilename()
    {
    	return time() . '.' . $this->format;
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
    	\Storage::disk('s3')->put('screenshots/' . $this->filename, file_get_contents(storage_path('app/screenshots/' . $this->filename)));

    	$this->removeLocalCopy();
    }

    public function removeLocalCopy()
    {
    	\Storage::disk('local')->delete('screenshots/' . $this->filename);
    }

    public function apiOutput()
    {
    	return [
    		'url' => 'https://s3.amazonaws.com/screendit/screenshots/' . $this->filename,
    		'expires_at' => $this->expires_at,
    		'cached' => $this->cached,
    	];
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
