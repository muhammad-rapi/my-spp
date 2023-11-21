<?php

namespace App\Http\Requests\Student;

use Illuminate\Foundation\Http\FormRequest;

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
            'name.required'     => 'Nama Siswa Tidak Boleh Kosong',
            'name.max'          => 'Nama Siswa Tidak Boleh Lebih Dari 50 Karakter',
            'major_id.required' => 'Jurusan Wajib Dipilih',
            'class.required'    => 'Kelas Tidak Boleh Kosong',
            'class.max'         => 'Kelas Tidak Boleh Lebih Dari 5 Karakter',
            'alamat.required'   => 'Alamat Tidak Boleh Kosong',
            'alamat.max'        => 'Alamat Terlalu Panjang',
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
            'name'     => 'required|max:225',
            'major_id' => 'required|max:5',
            'class'    => 'required|max:5',
            'address'  => 'required|max:225',
            'gender'  => 'max:11'
        ];

    }

}
