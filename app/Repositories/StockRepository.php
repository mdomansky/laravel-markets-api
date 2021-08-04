<?php


namespace App\Repositories;


use App\Models\Stock;

class BondRepository extends AssetRepository
{
    public function findByTickerOrCreate(string $ticker, array $attributes): Stock
    {
        return parent::findByModelAndTickerOrCreate(Stock::class, $ticker, $attributes);
    }
}
