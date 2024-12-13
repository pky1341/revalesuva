<?php

namespace App\Traits;

use App\Traits\JsonResponse;

trait ApiResponser
{
    protected function successResponse($data, $message = null, $code = 200)
    {
        
        if (isset($data) && !empty($data)) {
            return response()->json([
                'status' => $code,
                'message' => $message,
                'data' => $data,
            ]);
        } else {
            return response()->json([
                'status' => $code,
                'message' => $message,
            ]);
        }
    }

    protected function errorResponse($message, $code = 400)
    {
        return response()->json([
            'status' => $code,
            'message' => $message,
        ]);
    }

    public function logoutSuccessResponse()
    {
        return $this->successResponse([], 'Successfully logged out.');
    }
}
