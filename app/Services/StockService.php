<?php


namespace App\Services;


use App\Repositories\StockRepository;
use Illuminate\Support\Facades\Redis;

class StockService
{
    private StockRepository $stockRepository;

    public function __construct(StockRepository $stockRepository)
    {
        $this->stockRepository = $stockRepository;
    }

    public function findByTicker(string $ticker, array $with = [])
    {
        $stock = $this->stockRepository->findByTicker($ticker, $with);
        $this->stockRepository->increasePopularity($stock);

        return $stock;
    }

    public function getPopularStocks($limit = 5)
    {
        return $this->stockRepository->getPopularStocks($limit);
    }
}
