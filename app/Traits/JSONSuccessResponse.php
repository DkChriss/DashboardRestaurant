<?php
namespace App\Traits;

trait JSONSuccessResponse
{
    protected function successResponse($data, $code = 200)
    {
        return response()->json([
            'data' => $data,
            'code' => $code
        ], $code);
    }

    protected function successMessageResponse($message)
    {
        $this->successResponse($message);
    }
}
