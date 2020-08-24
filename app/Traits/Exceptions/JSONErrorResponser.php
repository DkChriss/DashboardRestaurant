<?php

namespace App\Traits\Exceptions;

trait JSONErrorResponser
{
    protected function errorResponse($message, $code)
    {
        return response()->json([
            'message' => $message,
            'code' => $code
        ], $code);
    }
}
