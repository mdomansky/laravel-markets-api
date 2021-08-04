<?php


namespace App\Repositories;


use App\Models\Currency;

class CurrencyRepository
{
    public function getCurrencyIdByCode($code): int
    {
        $currency = Currency::where('code', $code)->firstOrCreate()->refresh();
        return $currency->id;
    }
}
