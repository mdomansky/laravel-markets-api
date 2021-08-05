<?php


namespace App\Repositories;


use App\Models\Asset;
use App\Models\Price;
use Carbon\Carbon;

class PriceRepository
{
    public function findByAssetAndDateOrCreate(Asset $asset, Carbon $date, array $attributes)
    {
        return Price::firstOrCreate(
            [
                'asset_id' => $asset->id,
                'date' => $date->endOfDay(),
            ],
            $attributes
        );
    }
}
