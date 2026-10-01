<?php

namespace App\Http\Requests\Admin\Vinograd\Order;

use Illuminate\Foundation\Http\FormRequest;

class CustomerRequest extends FormRequest
{
    protected function prepareForValidation(): void
    {
        $this->merge([
            'customer' => array_merge(
                $this->customer,
                [
                    'phone' => preg_replace("/[^\d]/", '', $this->input('customer.phone'))
                ]
            ),
        ]);
    }

    public function rules()
    {
        return [
            'customer.name' => 'required|min:3|max:50|string',
            'customer.phone' => 'nullable|required_without:customer.email|min:9|max:15',
            'customer.email' => 'nullable|required_without:customer.phone|email',
        ];
    }

    public function messages()
    {
        return [
            'customer.name.required' => 'Имя обязательно.',
            'customer.email.required_without' => 'Нужен либо Email либо номер телефона.',
            'customer.phone.required_without' => 'Нужен либо Email либо номер телефона.',
            'customer.phone.min' => 'Оставьте корректный номер телефона.min',
            'customer.phone.max' => 'Оставьте корректный номер телефона.max',
//            'customer.phone.numeric' => 'Оставьте корректный номер телефона.',
        ];
    }
}
