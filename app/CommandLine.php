<?php

namespace App;

use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;

class CommandLine
{
	public static function execute($command)
	{
		$process = new Process($command);

		// Set the timeout below.
		// $process->setTimeout(60);
		
		$process->run();

		if (!$process->isSuccessful()) {
		    throw new ProcessFailedException($process);
		}

		return $process->getOutput();
	}
}