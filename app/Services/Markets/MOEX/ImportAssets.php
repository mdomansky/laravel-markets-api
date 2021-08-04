<?php


namespace App\Services\Markets\MOEX;


use App\Services\Markets\ImportAssetsInterface;
use Carbon\Carbon;

class ImportAssets implements ImportAssetsInterface
{
    public function importAssets(): void
    {
        app(ImportStocks::class)->import();
        app(ImportBonds::class)->import();
        app(ImportEtfs::class)->import();
    }

    public function importAssetPrices($asset, Carbon $from, Carbon $to = null): void
    {
        // TODO: Implement importStockPrices() method.
    }
}
