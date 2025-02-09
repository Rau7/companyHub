<?php

namespace App\Http\Requests\Employee;

use Illuminate\Foundation\Http\FormRequest;

class StoreEmployeeRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'company_id' => 'required|exists:companies,id',
            'email' => 'required|email|unique:employees,email',
            'phone' => 'nullable|string|max:255',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'first_name.required' => 'Ad alanı zorunludur.',
            'first_name.max' => 'Ad en fazla 255 karakter olabilir.',
            'last_name.required' => 'Soyad alanı zorunludur.',
            'last_name.max' => 'Soyad en fazla 255 karakter olabilir.',
            'company_id.required' => 'Şirket seçimi zorunludur.',
            'company_id.exists' => 'Seçilen şirket bulunamadı.',
            'email.required' => 'Email adresi zorunludur.',
            'email.email' => 'Geçerli bir email adresi giriniz.',
            'email.unique' => 'Bu email adresi zaten kullanılmakta.',
            'phone.max' => 'Telefon numarası en fazla 255 karakter olabilir.',
        ];
    }
}
