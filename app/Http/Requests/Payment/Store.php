<?php

namespace App\Http\Requests\Payment;

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
            'amount_payment.required'     => 'Nominal  Pembayaran Tidak Boleh Kosong',
            'student_id.required' => 'Siswa Tidak Boleh Kosong',
            'month.required' => 'Bulan Tidak Boleh Kosong',
            'year.required' => 'Tahun Tidak Boleh Kosong',
        ];
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return[
            'amount_payment'     => 'required',
            'student_id' => 'required',
            'month.*'        => 'in:January,February,March,April,May,June,July,August,September,October,November,December', 
            'month' => 'required',
            'year' => 'required'
        ];

    }

}
