<?php


namespace App\Services\Markets\MOEX;


use App\Repositories\AssetRepository;
use App\Services\Markets\ImportAssetsInterface;
use Carbon\Carbon;

class ImportAssets implements ImportAssetsInterface
{
    private AssetRepository $assetRepository;

    public function __construct(AssetRepository $assetRepository)
    {
        $this->assetRepository = $assetRepository;
    }

    public function importAssets(): void
    {
        app(ImportStocks::class)->import();
        app(ImportBonds::class)->import();
        app(ImportEtfs::class)->import();
    }

    public function importAssetPrices(string $ticker, Carbon $from, Carbon $to = null): void
    {
        app(ImportAssetPrices::class)->import($ticker, $from, $to);
    }
}
