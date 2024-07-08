<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use OpenApi\Annotations as OA;

final class IndexController extends Controller
{
    /**
     * @OA\Get(
     *      path="/api",
     *      operationId="base",
     *      tags={"developers"},
     *      summary="Base action",
     *      description="",
     *
     *      @OA\Response(response=200, description="Success"),
     *      @OA\Response(response=400, description="Something went wrong...")
     * )
     */
    public function index(): JsonResponse
    {
        return response()->json([
            'message' => 'Success',
        ]);
    }
}
