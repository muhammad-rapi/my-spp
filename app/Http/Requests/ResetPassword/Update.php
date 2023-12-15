<?php

namespace App\Http\Requests\ResetPassword;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Hash;

class Update extends FormRequest
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
            'current_password.required' => 'Password Saat Ini Tidak Boleh Kosong',
            'password.required'         => 'Password Baru Tidak Boleh Kosong',
            'password.min'              => 'Password Terlalu Pendek',
            'password.confirmed'    => 'Konfirmasi Password Tidak Sesuai',
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
            'current_password' => 'required',
            'password'         => 'required|min:8|confirmed',
        ];
    }


}
