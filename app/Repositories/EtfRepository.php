<?php


namespace App\Repositories;


use App\Models\Etf;

class EtfRepository extends AssetRepository
{
    public function findByTickerOrCreate(string $ticker, array $attributes): Etf
    {
        return parent::findByModelAndTickerOrCreate(Etf::class, $ticker, $attributes);
    }
}
