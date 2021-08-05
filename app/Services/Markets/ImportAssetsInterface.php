<?php


namespace App\Services\Markets;

use Carbon\Carbon;

interface ImportAssetsInterface
{
    public function importAssets(): void;

    public function importAssetPrices(string $ticker, Carbon $from, Carbon $to = null): void;

}
