<?php

namespace App\Http\Controllers\Api\Admin\Traits;

use Illuminate\Http\JsonResponse;

trait ResponseTrait
{
    /**
     * @param int $code
     * @param string $message
     * @param mixed $data
     * @return JsonResponse
     */
    protected function success(int $code = 1, string $message = '', mixed $data = []): JsonResponse
    {
        return $this->response($code, $message, $data);
    }

    /**
     * @param string $message
     * @param int $code
     * @param mixed $data
     * @return JsonResponse
     */
    protected function error(string $message, int $code = 0, mixed $data = []): JsonResponse
    {
        return $this->response($code, $message, $data);
    }

    /**
     * @param mixed $data
     * @param int $code
     * @param string $message
     * @return JsonResponse
     */
    protected function data(mixed $data = [], int $code = 1, string $message = 'Successfully'): JsonResponse
    {
        return $this->response($code, $message, $data);
    }

    /**
     * @param int $code
     * @param string $message
     * @param mixed $data
     * @return JsonResponse
     */
    protected function response(int $code, string $message, mixed $data): JsonResponse
    {
        return response()->json([
            'code' => $code,
            'message' => $message,
            'data' => $data,
        ]);
    }
}
