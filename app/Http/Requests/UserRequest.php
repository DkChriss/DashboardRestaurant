<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
        $rules = [
            'name' => 'required|regex:/^[a-zA-Z," ",""]+$/u|string',
            'lastname' => 'required|regex:/^[a-zA-Z]+$/u|string',
            'email' => 'required|email|unique:users,email',
            'username' => 'required|string|unique:users,username',
            'password' => 'required',
            'password_confirmation' => 'required|same:password',
            'address' => 'required|string',
            'phone' => 'required|regex:/^[0-9]+$/'
        ];
        if ($this->getMethod() === 'PATCH') {
            $rules['username'] = $rules ['username'] . ',' . $this->user->id;
            $rules['email'] = $rules ['email'] . ',' . $this->user->id;
            $rules['password'] = '';

            $rules['password_confirmation'] = '';
        }

        return $rules;
    }
}