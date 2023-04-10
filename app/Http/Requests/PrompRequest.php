<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PrompRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'promp' => ['required', 'min:8']
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
