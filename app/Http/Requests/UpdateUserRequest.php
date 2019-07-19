<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
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
        $id = $this->route('id');

        return [
            'first_name' => 'required|min:2|max:255',
            'last_name' => 'required|min:2|max:255',
            'address' => 'required|min:2|max:255',
            'post_code' => 'required|max:10',
            'contact_phone_number' => 'required|max:20',
            'password' => 'confirmed',
            'email' => 'required|unique:users,email,'.$id,
            'username' => 'required|unique:users,username,'.$id
        ];
    }
}
