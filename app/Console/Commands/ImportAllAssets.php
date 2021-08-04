<?php

namespace App\Console\Commands;

use App\Services\Markets\ImportAssetsInterface;
use Illuminate\Console\Command;

class ImportAllAssets extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'data:import-all-assets';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'The command retrieves all data from all markets. For each asset it gets prices for the whole period. If data is exists - skip.';

    private $importAssetsService;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(ImportAssetsInterface $importAssetsService)
    {
        $this->importAssetsService = $importAssetsService;
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->info('Assets import has been started');

        $this->importAssetsService->importAssets();

        $this->info('Assets has been imported');
    }
}
