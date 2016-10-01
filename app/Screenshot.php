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

    		$screenshotOptions = ScreenshotOptions::prepare($rawOptions);

    		$model = self::create($screenshotOptions->toArray());

    		\Auth::user()->screenshots()->save($model);

    		$tempFilename = time() . '.' . $screenshotOptions->getExtension();

    		$tempFilePath = storage_path('app/screenshots/' . $tempFilename);
            
    		CommandLine::execute(ScreenshotCommandGenerator::generate($tempFilePath, $screenshotOptions->formatForCommand()));

    		$model->uploadToS3($tempFilePath);

            $model->removeLocalCopy($tempFilename);

            $model->recordRequest();

    		$model->save();
    		
    		return $model;
    	});
    }

    public function uploadToS3($tempFilePath)
    {
        $key = $this->user->s3_key;
        $secret = $this->user->s3_secret;
        $bucket = $this->user->s3_bucket;

        if (!$key && !$secret && !$bucket) {
            throw new \Exception('You need to add your S3 credentials');
        }

        \Config::set('filesystems.disks.s3.key', $key);
        \Config::set('filesystems.disks.s3.secret', $secret);
        \Config::set('filesystems.disks.s3.bucket', $bucket);

    	\Storage::disk('s3')->put($this->file, file_get_contents($tempFilePath));
    }

    public function removeLocalCopy($tempFilename)
    {
    	\Storage::disk('local')->delete('screenshots/' . $tempFilename);
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
