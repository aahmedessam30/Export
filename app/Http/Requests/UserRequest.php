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
        if ($this->isMethod('POST')) {
            return [
                'name'     => ['required', 'string', 'max:255'],
                'email'    => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'password' => ['required', 'string', 'min:8'],
                'username' => ['required', 'unique:users,username', 'string'],
                'phone'    => ['required', 'regex:/(01)[0-9]{9}/']
            ];
        } elseif ($this->isMethod('PUT') || $this->isMethod('PATCH')) {
            return [
                'name'     => ['sometimes', 'string', 'max:255'],
                'email'    => ['sometimes', 'string', 'email', 'max:255', 'unique:users'],
                'password' => ['sometimes', 'string', 'min:8'],
                'username' => ['sometimes', 'unique:users,username', 'string'],
                'phone'    => ['sometimes', 'regex:/(01)[0-9]{9}/']
            ];
        }
    }
}
