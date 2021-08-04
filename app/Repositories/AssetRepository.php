<?php


namespace App\Repositories;


use App\Models\Asset;

class AssetRepository
{
    public function findByModelAndTickerOrCreate($model, string $ticker, array $attributes)
    {
        $asset = Asset::firstOrCreate(['ticker' => $ticker], $attributes);

        return $model::firstOrCreate(
            [
                'asset_id' => $asset->id,
            ],
            array_merge(['asset_id' => $asset->id], $attributes)
        );

    }
}
