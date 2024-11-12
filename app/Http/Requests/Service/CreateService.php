<?php

namespace App\Http\Requests\Service;

use Illuminate\Foundation\Http\FormRequest;

class CreateService extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'service_title_ar'=> 'required',
            'service_title_en'=> 'required',
            'service_des_ar'=> 'required',
            'service_des_en'=> 'required',
            'photo'=> 'nullable|image|size:1024|mimes:jpeg,png,jpg,gif',
        ];
    }

    public function messages(): array
    {
        return [
            'service_title_ar.required' => '
                بيانات العنوان بالعربية لا يمكن تركها فارغة.',
            'service_title_en.required' => '
            بيانات العنوان بالانجليزية لا يمكن تركها فارغة.',
            'service_des_ar.required' => '
            بيانات الوصف بالعربية لا يمكن تركها فارغة.',
            'service_des_en.required' => '
            بيانات الوصف بالانجليزية لا يمكن تركها فارغة.',
            'photo'=>'الصورة لا يجب ان تكون اكبر من 1 ميجا',
        ];
    }
}
