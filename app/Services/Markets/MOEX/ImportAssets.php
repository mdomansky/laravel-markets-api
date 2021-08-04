<?php


namespace App\Services\Markets\MOEX;


use App\Services\Markets\ImportAssetsInterface;
use Carbon\Carbon;

class ImportAssets implements ImportAssetsInterface
{
    public function importAssets(): void
    {
        app(ImportStocks::class)->importStocksList();
        app(ImportEtfs::class)->importStocksList();
        app(ImportBonds::class)->importStocksList();
    }

    public function importAssetPrices($asset, Carbon $from, Carbon $to = null): void
    {
        // TODO: Implement importStockPrices() method.
    }
}
