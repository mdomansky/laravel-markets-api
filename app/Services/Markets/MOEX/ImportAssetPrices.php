<?php


namespace App\Services\Markets\MOEX;


use App\Repositories\AssetRepository;
use App\Repositories\PriceRepository;
use Carbon\Carbon;

class ImportAssetPrices
{
    private AssetRepository $assetRepository;
    private PriceRepository $priceRepository;

    public function __construct(AssetRepository $assetRepository, PriceRepository $priceRepository)
    {
        $this->assetRepository = $assetRepository;
        $this->priceRepository = $priceRepository;
    }

    public function import(string $ticker, Carbon $from, Carbon $to = null): void
    {
        $asset = $this->assetRepository->findByTicker($ticker);
        $urls = $this->getMoexPricesUrl($ticker, $asset->getType(), $from, $to);

        foreach ($urls as $url) {
            $xmlDataString = file_get_contents($url);
            $xmlObject = simplexml_load_string($xmlDataString);
            $prices = json_decode(json_encode($xmlObject), true)['data']['rows']['row'] ?? [];
            if (isset($prices['@attributes'])) {
                $prices = [$prices];
            }

            foreach ($prices as $price) {
                $price = $price['@attributes'];

                $this->priceRepository->findByAssetAndDateOrCreate(
                    $asset,
                    Carbon::createFromFormat('Y-m-d', $price['TRADEDATE']),
                    [
                        'price' => $price['CLOSE'],
                    ],
                );
            }
        }
    }

    private function getMoexPricesUrl(string $ticker, $type, Carbon $from, Carbon $to = null): array
    {
        $types = [
            'stock' => ['TQBR'],
            'bond' => ['TQOB', 'TQCB'],
            'etf' => ['TQTF'],
        ];
        $markets = [
            'stock' => 'shares',
            'bond' => 'bonds',
            'etf' => 'shares',
        ];

        $urls = [];
        foreach ($types[$type] as $t) {
            $url = sprintf(
                'https://iss.moex.com/iss/history/engines/stock/markets/%s/boards/%s/securities/%s.xml?from=%s',
                $markets[$type],
                $t,
                $ticker,
                $from->format('Y-m-d')
            );

            if ($to && $from < $to) {
                $urls[] = $url . '&to=' . $to->format('Y-m-d');
            } else {
                $urls[] = $url . '&limit=1';
            }
        }

        return $urls;
    }
}
