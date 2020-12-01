<?php

namespace App\Http\Requests\API;

/**
 * Class UserLoginRequest
 * @package App\Http\Requests\API
 */
class UserLoginRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'email' => 'required|email',
            'password' => 'required'
        ];
    }
}
