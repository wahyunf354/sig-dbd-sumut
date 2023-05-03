<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePengaduanRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
        ];
    }

    public function messages()
    {
        return [
            "name.required" => "Kolom nama harus diisi",
            "email.required" => "Kolom email harus diisi",
            "subject.required" => "Kolom subject harus diisi"
        ];
    }
}
