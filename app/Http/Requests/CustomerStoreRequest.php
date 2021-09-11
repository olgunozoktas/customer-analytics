<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CustomerStoreRequest extends FormRequest
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
            'name' => 'required|min:4|max:50',
            'email' => 'required|email|max:50',
            'gsm_no' => 'required|max:25',
            'birthday' => 'required|date',
            'department_id' => 'required|exists:departments,id'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Müşterinin Tam Adı Girilmelidir',
            'name.min' => 'Müşterinin Tam Adı En Az :min Karakter Olmalıdır',
            'name.max' => 'Müşterinin Tam Adı En Fazla :max Karakter Olabilir',
            'email.required' => 'Müşterinin Email Adresi Girilmelidir',
            'email.email' => 'Girilen Email Adresi Geçerli Olmalıdır',
            'email.max' => 'Girilen Email Adresi Maksimum :max Karakter Olabilir',
            'gsm_no.required' => 'Müşterinin GSM Numarası Girilmelidir',
            'gsm_no.max' => 'Girilen GSM Numarası Maksimum :max Karakter Olabilir',
            'birthday.required' => 'Müşterinin Doğum Tarihi Girilmelidir',
            'birthday.date' => 'Girilen Tarih Bilgisi Geçerli Değildir!',
            'department_id.required' => 'Müşterinin Birimi Seçilmelidir',
            'department_id.exists' => 'Seçilen Birim Geçerli Değildir!'
        ];
    }
}
