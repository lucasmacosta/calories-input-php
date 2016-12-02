<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserPost extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        // We'll handle authorization in other place
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        // Email is unique among table users
        $email_rule = 'required|email|max:255|unique:users';

        if ($this->method() === 'PUT') {
            // When updating, omit email from current user during unique check
            $email_rule .= ',email,' . $this->route('user')->id;
            // Password it's not required when updating user
            $password_rule = 'min:6|confirmed';
        } else {
            $password_rule = 'required|min:6|confirmed';
        }

        return [
            'name' => 'required|max:255',
            'email' => $email_rule,
            'password' => $password_rule,
            'role' => 'in:user,usersManager,admin',
            'calories_per_day' => 'integer|min:0',
        ];
    }
}
