<?php

namespace App\Http\Requests\ApiV1;

use App\Exceptions\Api\ApiException;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class BaseRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    /**
     * @throws ApiException
     */
    protected function failedValidation(Validator $validator):void
    {
        throw new ApiException($validator->errors()->first(), 400);
    }
}
