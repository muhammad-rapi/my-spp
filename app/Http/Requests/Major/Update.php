<?php

namespace App\Http\Requests\Major;

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
            'name.required'     => 'Nama Jurusan Tidak Boleh Kosong',
            'name.max'          => 'Nama Jurusan Tidak Boleh Lebih Dari 50 Karakter',
            'category.required' => 'Kategori Jurusan Tidak Boleh Kosong',
            'category.max'      => 'Kategori Jurusan Tidak Boleh Lebih Dari 50 Karakter',
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
            'category' => 'required|max:50',
        ];
    }

}
