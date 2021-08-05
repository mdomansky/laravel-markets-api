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

    /**
     * @OA\Get(
     *     path="/api/stocks/{ticker}",
     *     summary="Returns stock data",
     *     description="",
     *     tags={"Stocks"},
     *     @OA\Parameter(
     *         name="ticker",
     *         description="Ticker name",
     *         in = "path",
     *         required=true,
     *         @OA\Schema(
     *             type="string"
     *         ),
     *         example="SBER"
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Returns JSON data of the stock",
     *     ),
     * )
     */
    public function show(Request $request, $ticker)
    {
        $stock = $this->stockService->findByTicker($ticker, ['stock', 'prices']);

        return response()->json($stock);
    }

    /**
     * @OA\Get(
     *     path="/api/stocks/popular",
     *     summary="Returns 10 most popular stocks",
     *     description="",
     *     tags={"Stocks"},
     *     @OA\Response(
     *         response=200,
     *         description="Returns JSON array of stocks",
     *     ),
     * )
     */
    public function popular()
    {
        $stocks = $this->stockService->getPopularStocks(10);

        return response()->json($stocks);
    }
}
