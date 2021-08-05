<?php


namespace App\Repositories;


use App\Models\Asset;
use App\Models\Stock;
use Illuminate\Support\Facades\Redis;

class StockRepository extends AssetRepository
{
    public function findByTickerOrCreate(string $ticker, array $attributes): Stock
    {
        return parent::findByModelAndTickerOrCreate(Stock::class, $ticker, $attributes);
    }

    public function increasePopularity(Asset $stock): void
    {
        Redis::zincrby('trending_stocks', 1, $stock);
    }

    public function getPopularStocks(int $limit = 5): array
    {
        $stocksFromRedis = Redis::zrevrange('trending_stocks', 0, $limit - 1);

        return array_map('json_decode', $stocksFromRedis);
    }
}
