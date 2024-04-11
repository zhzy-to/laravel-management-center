<?php

namespace App\Http\Requests\ApiV1;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class PasswordLoginRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'username' => 'bail|required',
            'password' => 'required',
        ];
    }

    public function filldata(): array
    {
        return [
            'username' => $this->post('username'),
            'password' => $this->post('password'),
        ];
    }
}
