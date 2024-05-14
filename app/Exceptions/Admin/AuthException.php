<?php

namespace App\Exceptions\Admin;

use App\Enums\ErrorCodeEnum;
use App\Http\Controllers\Api\Admin\Traits\ResponseTrait;
use Illuminate\Http\JsonResponse;
use Throwable;

class AuthException extends \Exception
{
    use ResponseTrait;

    public function __construct($message, $errorCode, Throwable $previous = null)
    {
        if ($errorCode instanceof ErrorCodeEnum) {
            $code = $errorCode->value;
        } else {
            $code = $errorCode;
        }

        parent::__construct($message, $code, $previous);
    }

    /**
     * @return JsonResponse
     */
    public function render(): JsonResponse
    {
        return $this->error($this->getMessage(), $this->getCode());
    }
}
