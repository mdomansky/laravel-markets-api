<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class GetAllAssets extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'data:get-all-assets';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'The command retrieves all data from all markets. For each asset it gets prices for the whole period. If data is exists - skip.';

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
     * @return int
     */
    public function handle()
    {
        return 0;
    }
}
