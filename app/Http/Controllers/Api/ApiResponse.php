<?php

namespace App\Http\Controllers\Api;

trait ApiResponse
{
    protected function response($status, $data = [])
    {
        return response()->json($data, $status);
    }
}
