<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class TestConnection extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'db:test';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        try {
            DB::connection()->getPdo();
            echo "Connected successfully to: " . DB::connection()->getDatabaseName();
        } catch (\Exception $e) {
            die("Could not connect to the database. Please check your configuration. error:" . $e);
        }
    }
}
