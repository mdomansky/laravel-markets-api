<?php

namespace App\Http\Controllers\API;

use App\Services\StockService;
use Illuminate\Http\Request;

class StockController extends AssetController
{
    private StockService $stockService;

    public function __construct(StockService $stockService)
    {
        $this->stockService = $stockService;
    }

    public function show(Request $request, $ticker)
    {
        $stock = $this->stockService->findByTicker($ticker, ['stock', 'prices']);

        return response()->json($stock);
    }


    public function popular()
    {
        $stocks = $this->stockService->getPopularStocks(10);

        return response()->json($stocks);
    }
}
