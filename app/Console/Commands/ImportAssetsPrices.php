<?php

namespace App\Console\Commands;

use App\Repositories\AssetRepository;
use App\Services\Markets\ImportAssetsInterface;
use Carbon\Carbon;
use Illuminate\Console\Command;

class ImportAssetsPrices extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'data:import-assets-prices';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'The command imports price history of all assets.';

    private AssetRepository $assetRepository;
    private ImportAssetsInterface $importAssets;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(ImportAssetsInterface $importAssets, AssetRepository $assetRepository)
    {
        $this->importAssets = $importAssets;
        $this->assetRepository = $assetRepository;
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->info('Assets prices import has been started');

        $assets = $this->assetRepository->all();
        $bar = $this->output->createProgressBar(count($assets));

        foreach ($assets as $asset) {
            $this->importAssets->importAssetPrices($asset->ticker, Carbon::yesterday());

            $bar->advance();
//            $this->info('Ticker: ' . $asset->ticker);
        }

        $bar->finish();

        $this->info('Assets price history has been imported');
    }
}
