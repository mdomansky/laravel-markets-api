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


    public function index(): JsonResponse
    {
        $assets = $this->assetRepository->all();

        return response()->json($assets);
    }

    public function popular()
    {

    }
}
