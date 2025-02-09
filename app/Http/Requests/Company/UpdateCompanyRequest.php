<?php

namespace App\Http\Requests\Company;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCompanyRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:companies,email,' . $this->company->id,
            'website' => 'nullable|url',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048|dimensions:min_width=100,min_height=100',
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
            'name.required' => 'Şirket adı zorunludur.',
            'name.max' => 'Şirket adı en fazla 255 karakter olabilir.',
            'email.required' => 'Email adresi zorunludur.',
            'email.email' => 'Geçerli bir email adresi giriniz.',
            'email.unique' => 'Bu email adresi zaten kullanılmakta.',
            'website.url' => 'Geçerli bir website adresi giriniz.',
            'logo.image' => 'Logo bir resim dosyası olmalıdır.',
            'logo.mimes' => 'Logo JPEG, PNG, JPG veya GIF formatında olmalıdır.',
            'logo.max' => 'Logo boyutu en fazla 2MB olabilir.',
            'logo.dimensions' => 'Logo en az 100x100 piksel boyutunda olmalıdır.',
        ];
    }
}
