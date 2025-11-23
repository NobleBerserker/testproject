<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Services\FacebookService;

class FacebookController extends Controller
{
    public function test(FacebookService $fbService)
    {
        $response = $fbService->testConnection();

        if ($response->failed()) {
            return $response()->json([
                'status' => 'error',
                'message' => $response->body(),
            ],400);
        }

        return response()->json([
            'status' => 'ok',
            'data' => $response->body(),
        ]);
    }
}
