<?php


namespace App\Repositories;



use App\Models\Bond;

class BondRepository extends AssetRepository
{
    public function findByTickerOrCreate(string $ticker, array $attributes): Bond
    {
        return parent::findByModelAndTickerOrCreate(Bond::class, $ticker, $attributes);
    }
}
