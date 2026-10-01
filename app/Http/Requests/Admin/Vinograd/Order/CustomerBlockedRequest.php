<?php

namespace App\Http\Requests\Admin\Vinograd\Order;

use Illuminate\Foundation\Http\FormRequest;

class CustomerBlockedRequest extends FormRequest
{
    protected function prepareForValidation(): void
    {
        $this->merge([
            'phone' => ignorPhone(preg_replace("/[^\d]/", '', $this->phone)),
        ]);
    }

    public function rules()
    {
        return [
            'phone' => 'nullable|required_without:email|min:9',
            'email' => 'nullable|required_without:phone|email',
            'note' => 'nullable|string',
        ];
    }

    public function messages()
    {
        return [
            'phone.integer' => 'Не корректный номер телефона.',
            'phone.required_without' => 'Должен присутствовать либо телефон либо email.',
            'email.email' => 'Не корректный email',
            'email.required_without' => 'Должен присутствовать либо телефон либо email.',
            'name.string' => 'Не корректное примечание',
        ];
    }
}
