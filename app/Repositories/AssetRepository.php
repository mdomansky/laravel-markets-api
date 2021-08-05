<?php


namespace App\Repositories;


use App\Models\Asset;
use Illuminate\Database\Eloquent\Collection;

class AssetRepository
{
    public function all(): Collection
    {
        return Asset::with(['stock', 'bond', 'etf'])->get();
    }

    public function findByTicker(string $ticker, array $with = [])
    {
        return Asset::where('ticker', $ticker)->with($with)->firstOrFail();
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
