<?php


namespace App\Services\Markets\MOEX;


use App\Repositories\CurrencyRepository;
use App\Repositories\BondRepository;

class ImportBonds
{
    private BondRepository $bondRepository;
    private CurrencyRepository $currencyRepository;
    private array $moexBondsUrls = [
        'https://iss.moex.com/iss/engines/stock/markets/bonds/boards/TQOB/securities.xml',
        'https://iss.moex.com/iss/engines/stock/markets/bonds/boards/TQCB/securities.xml',
    ];

    public function __construct(BondRepository $bondRepository, CurrencyRepository $currencyRepository)
    {
        $this->bondRepository = $bondRepository;
        $this->currencyRepository = $currencyRepository;
    }

    public function importStocksList(): void
    {
        foreach ($this->moexBondsUrls as $url) {
            $xmlDataString = file_get_contents($url);
            $xmlObject = simplexml_load_string($xmlDataString);
            $stocks = json_decode(json_encode($xmlObject), true)['data'][0]['rows']['row'] ?? null;

            foreach ($stocks as $stock) {
                $stock = $stock['@attributes'];

                $this->bondRepository->findByTickerOrCreate(
                    $stock['SECID'],
                    [
                        'name' => $stock['SHORTNAME'],
                        'long_name' => $stock['SECNAME'],
                        'currency_id' => $this->currencyRepository->getCurrencyIdByCode($stock['CURRENCYID']),
                        'isin' => $stock['ISIN'],
                        'papers_in_lot' => $stock['LOTSIZE'],
                    ]
                )->refresh();
            }
        }
    }
}
