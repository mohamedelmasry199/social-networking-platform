<?php
// app/Http/Responses/ApiResponse.php

namespace App\Http\Responses;

class ApiResponse
{
    public static function success($data = null, $message = null, $statusCode = 200)
    {
        return response()->json([
            'success' => true,
            'data' => $data,
            'message' => $message
        ], $statusCode);
    }

    public static function error($message = null, $statusCode = 500)
    {
        return response()->json([
            'success' => false,
            'error' => [
                'message' => $message,
                'status_code' => $statusCode
            ]
        ], $statusCode);
    }
}
