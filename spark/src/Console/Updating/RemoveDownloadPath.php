<?php

namespace Laravel\Spark\Console\Updating;

use Exception;
use Illuminate\Filesystem\Filesystem;

class RemoveDownloadPath
{
    /**
     * Create a new command instance.
     *
     * @param  \Illuminate\Console\Command  $command
     * @param  string  $downloadPath
     * @return void
     */
    public function __construct($command)
    {
        $command->line('Removing Temporary Download Directory: <info>✔</info>');
    }

    /**
     * Update the components.
     *
     * @return void
     */
    public function update()
    {
        (new Filesystem)->deleteDirectory(base_path('spark-new'));
    }
}
