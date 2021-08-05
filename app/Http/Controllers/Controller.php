<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    /**
     * @OA\Info(
     *      version="1.0.0",
     *      title="Laravel Markets API Documentation",
     *      description="Some endpoints just to show how it works and how you should use it",
     *      @OA\Contact(
     *          email="mx.mixer@gmail.com"
     *      ),
     * )
     *
     * @OA\Server(
     *      url="http://localhost:8000",
     *      description="Dev local API server"
     * )
     */
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
}
