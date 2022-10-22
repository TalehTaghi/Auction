<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public static function respond($message = "", $data = [], $error_key = null, $code = ResponseAlias::HTTP_OK): \Illuminate\Http\JsonResponse
    {
        $response = [
            'success' => !(bool)$error_key,
            'data' => $data,
            'message' => $message,
            'error_key' => $error_key
        ];

        return response()->json($response, $code);
    }
}
