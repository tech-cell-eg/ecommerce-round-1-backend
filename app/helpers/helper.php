<?php

function responseJson($status, $message, $data = null)
{
    return response()->json([
        'status' => $status,
        'message' => $message,
        'data' => $data
    ]);
}