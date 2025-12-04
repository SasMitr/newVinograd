<?php

namespace App\Http\Requests\Admin\Vinograd\Excel;

use Illuminate\Foundation\Http\FormRequest;

class CatalogImportRequest extends FormRequest
{

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
        if (!in_array($this->file->getClientOriginalExtension(), ['xlsx'])) {
            throw \Illuminate\Validation\ValidationException::withMessages(['Нужен файл excel']);
        }

        return [
            'file' => 'required|file'
        ];
    }
}
