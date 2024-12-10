<?php

namespace App\Traits;
use App\Traits\JsonResponse;

trait ApiResponser
{
    protected function successResponse($data, $message = null, $code = 200)
    {
        return response()->json([
            'success' => true,
            'message' => $message,
            'data' => $data,
        ], $code);
    }

    protected function errorResponse($message, $code = 400)
    {
        return response()->json([
            'status' => $code,
            'success' => false,
            'message' => $message,
        ], $code);
    }

    public function logoutSuccessResponse()
    {
        return $this->successResponse([], 'Successfully logged out.');
    }
}
