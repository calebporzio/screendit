<?php

namespace App\Console\Commands;

use App\Screenshot;
use Illuminate\Console\Command;

class DeleteExpiredScreenshots extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'screendit:clear-screenshots';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Deletes screenshots that are expired from Amazon s3';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        Screenshot::deleteExpired();
    }
}
