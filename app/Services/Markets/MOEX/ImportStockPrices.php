<?php


namespace App\Services\Markets\MOEX;


use App\Repositories\CurrencyRepository;

class ImportStockPrices
{
    private StockRepository $stockRepository;
    private CurrencyRepository $currencyRepository;
    private string $moexStocksUrl = 'https://iss.moex.com/iss/engines/stock/markets/shares/boards/TQBR/securities.xml';

    public function __construct(StockRepository $stockRepository, CurrencyRepository $currencyRepository)
    {
        $this->stockRepository = $stockRepository;
        $this->currencyRepository = $currencyRepository;
    }

    public function importStockPrices(): void
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
                ]
            )->refresh();
        }
    }
}
