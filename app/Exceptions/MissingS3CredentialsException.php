<?php

namespace App\Exceptions;

class MissingS3CredentialsException extends \Exception
{
	public function __construct()
	{
		parent::__construct('You need to add your S3 credentials');
	}
}