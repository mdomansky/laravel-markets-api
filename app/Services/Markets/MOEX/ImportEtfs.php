<?php


namespace App\Services\Markets\MOEX;


use App\Repositories\CurrencyRepository;
use App\Repositories\EtfRepository;

class ImportEtfs
{
    private EtfRepository $etfRepository;
    private CurrencyRepository $currencyRepository;
    private string $moexEtfsUrl = 'https://iss.moex.com/iss/engines/stock/markets/shares/boards/TQTF/securities.xml';

    public function __construct(EtfRepository $etfRepository, CurrencyRepository $currencyRepository)
    {
        $this->etfRepository = $etfRepository;
        $this->currencyRepository = $currencyRepository;
    }

    public function import(): void
    {
        $xmlDataString = file_get_contents($this->moexEtfsUrl);
        $xmlObject = simplexml_load_string($xmlDataString);
        $stocks = json_decode(json_encode($xmlObject), true)['data'][0]['rows']['row'] ?? null;

        foreach ($stocks as $stock) {
            $stock = $stock['@attributes'];

            $this->etfRepository->findByTickerOrCreate(
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
