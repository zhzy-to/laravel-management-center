<?php

namespace App\Http\Requests\Admin;

use App\Exceptions\Admin\FormException;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class BaseRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    /**
     * @throws FormException
     */
    protected function failedValidation(Validator $validator):void
    {
        throw new FormException($validator->errors()->first(), 400);
    }
}
