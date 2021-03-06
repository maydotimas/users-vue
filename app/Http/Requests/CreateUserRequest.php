<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'first_name' => 'required|min:2|max:255',
            'last_name' => 'required|min:2|max:255',
            'address' => 'required|min:2|max:255',
            'post_code' => 'required|max:10',
            'contact_phone_number' => 'required|max:20',
            'password' => 'required|confirmed',
            'email' => 'required|email|unique:users,email',
            'username' => 'required|min:2|unique:users,username',
        ];
    }
}
