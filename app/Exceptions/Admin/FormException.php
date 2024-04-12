<?php

namespace App\Exceptions\Admin;

use App\Http\Controllers\Api\Admin\Traits\ResponseTrait;
use Illuminate\Http\JsonResponse;

class FormException extends \Exception
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
