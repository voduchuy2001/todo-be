<?php

namespace App\Helpers;

class BaseHelper
{
    public static function sendResponse($result, $message)
    {
        $response = [
            'success' => true,
            'data'    => $result,
            'message' => $message,
        ];

        return response()->json($response, 200);
    }

    public static function sendError($error, $message = [], $code = 400)
    {
        $response = [
            'success' => false,
            'message' => $error,
        ];

        if (! empty($message)) {
            $response['data'] = $message;
        }

        return response()->json($response, $code);
    }
}
