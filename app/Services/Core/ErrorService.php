<?php

namespace App\Services\Core;

use Exception;
use Illuminate\Http\{JsonResponse, Request};
use Symfony\Component\HttpFoundation\{Response};
use Illuminate\Support\Facades\Log;

class ErrorService
{
    public static function sendError(Exception $e): ?JsonResponse
    {

        Log::info($e);

        if (config('app.env') === 'production') {
            abort(response()->json([
                'message' => 'Falha detectada, favor entrar em contato com o suporte',
            ], Response::HTTP_INTERNAL_SERVER_ERROR));

            return response()->json([
                'message' => 'Falha detectada, favor entrar em contato com o suporte'
            ],
                Response::HTTP_OK
            );
        }

        abort(response()->json([
            'message' => 'Falha detectada, favor entrar em contato com o suporte',
            'errors'  => $e->getMessage(),
        ], Response::HTTP_INTERNAL_SERVER_ERROR));
    }
}
