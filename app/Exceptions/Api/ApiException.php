<?php

namespace App\Exceptions\Api;

use App\Http\Controllers\Api\V1\Traits\ResponseTrait;
use Illuminate\Http\JsonResponse;

class ApiException extends \Exception
{
    use ResponseTrait;

    /**
     * @return JsonResponse
     */
    public function render(): JsonResponse
    {
        return $this->error($this->getMessage(), $this->getCode());
    }
}
