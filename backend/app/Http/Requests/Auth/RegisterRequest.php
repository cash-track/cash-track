<?php

namespace App\Http\Requests\Auth;

use Auth;
use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return !Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name'      => 'required|string|max:50',
            'last_name' => 'string|max:50',
            'nick'      => 'alpha_dash|max:30|unique:users,nick',
            'email'     => 'required|email|max:255|unique:users',
            'password'  => 'required|min:6|confirmed',
        ];
    }
}
