<?php

namespace App\Http\Requests\User;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;

class Store extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    public function messages(): array
    {
        return [
            'name.required'     => 'Nama Pengguna Tidak Boleh Kosong',
            'role.required' => 'Pengguna Wajib Dipilih',
            'email.required' => 'Email Tidak Boleh Kosong',
            'email.unique' => 'Email Sudah Terdaftar',
            'phone.unique' => 'No Hp Sudah Terdaftar',
            'phone.min' => 'No Hp Terlalu Pendek',
            'password.required' => 'Password Tidak Boleh Kosong',
            'password.min' => 'Password Terlalu Pendek',
        ];
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'name'     => 'required|max:50',
            'role'     => 'required|in:admin,operator',
            'email'     => 'required|max:50|unique:users',
            'phone'     => 'unique:users',
            'password' => 'required|min:6',
        ];
    }
    

}
