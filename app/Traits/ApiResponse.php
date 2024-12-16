<?php

namespace App\Traits;

trait ApiResponse
{
    /**
     * Returns a successful response with the given status, message, and data.
     *
     * The response will have a JSON content type and will contain a 'status',
     * 'message', and 'data' key.
     *
     * @param int $status
     * @param string $message
     * @param mixed $data
     * @return \Illuminate\Http\JsonResponse
     */
    public function success($status, $message, $data = null)
    {
        return response()->json([
            'status' => $status,
            'message' => $message,
            'data' => $data
        ]);
    }


    /**
     * Returns a failed response with the given status, message, and data.
     *
     * The response will have a JSON content type and will contain a 'status',
     * 'message', and 'data' key.
     *
     * @param int $status
     * @param string $message
     * @param mixed $data
     * @return \Illuminate\Http\JsonResponse
     */
    public function failed($status = 402, $message, $data = null)
    {
        return response()->json([
            'status' => $status,
            'message' => $message,
            'data' => $data
        ], $status);
    }
}