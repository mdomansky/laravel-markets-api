<?php


namespace App\Repositories;


use App\Models\Asset;
use Illuminate\Database\Eloquent\Collection;

class AssetRepository
{
    public function all(): Collection
    {
        return Asset::all();
    }

    public function findByTicker(string $ticker)
    {
        return Asset::where('ticker', $ticker)->firstOrFail();
    }

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
