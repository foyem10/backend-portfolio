<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Throwable;

class HealthController extends Controller
{
    /** Utilisé par Docker, Railway et la CI pour savoir si l'API et la base répondent. */
    public function __invoke(): JsonResponse
    {
        try {
            DB::connection()->getPdo();
            $database = true;
        } catch (Throwable) {
            $database = false;
        }

        return response()->json(
            ['status' => $database ? 'ok' : 'degraded', 'database' => $database],
            $database ? 200 : 503,
        );
    }
}