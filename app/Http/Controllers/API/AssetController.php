<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Repositories\AssetRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AssetController extends Controller
{
    private AssetRepository $assetRepository;

    public function __construct(AssetRepository $assetRepository)
    {
        $this->assetRepository = $assetRepository;
    }


    /**
     * @OA\Get(
     *     path="/api/assets",
     *     summary="Returns all assets",
     *     description="",
     *     tags={"Assets"},
     *     @OA\Response(
     *         response=200,
     *         description="Returns JSON array of assets",
     *     ),
     * )
     */
    public function index(): JsonResponse
    {
        $assets = $this->assetRepository->all(['stock', 'bond', 'etf']);

        return response()->json($assets);
    }
}
