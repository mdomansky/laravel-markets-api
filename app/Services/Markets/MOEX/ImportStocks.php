<?php


namespace App\Services\Markets\MOEX;


use App\Repositories\CurrencyRepository;
use App\Repositories\BondRepository;

class ImportStocks
{
    private BondRepository $stockRepository;
    private CurrencyRepository $currencyRepository;
    private string $moexStocksUrl = 'https://iss.moex.com/iss/engines/stock/markets/shares/boards/TQBR/securities.xml';
    private $types = [
        1 => 'general',
        2 => 'privileges',
    ];

    public function __construct(BondRepository $stockRepository, CurrencyRepository $currencyRepository)
    {
        $this->stockRepository = $stockRepository;
        $this->currencyRepository = $currencyRepository;
    }

    public function importStocksList(): void
    {
        $xmlDataString = file_get_contents($this->moexStocksUrl);
        $xmlObject = simplexml_load_string($xmlDataString);
        $stocks = json_decode(json_encode($xmlObject), true)['data'][0]['rows']['row'] ?? null;

        foreach ($stocks as $stock) {
            $stock = $stock['@attributes'];

            $this->stockRepository->findByTickerOrCreate(
                $stock['SECID'],
                [
                    'name' => $stock['SHORTNAME'],
                    'long_name' => $stock['SECNAME'],
                    'currency_id' => $this->currencyRepository->getCurrencyIdByCode($stock['CURRENCYID']),
                    'isin' => $stock['ISIN'],
                    'papers_in_lot' => $stock['LOTSIZE'],
                    'type' => $this->types[$stock['SECTYPE']] ?? $this->types[1],
                ]
            )->refresh();
        }
    }
}
