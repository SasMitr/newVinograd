<?php

namespace App\Http\Requests\Admin\Vinograd\Order;

use Illuminate\Foundation\Http\FormRequest;

class CustomerRequest extends FormRequest
{
    public function rules()
    {
        return [
            'customer.name' => 'required|min:3|max:50|string',
            'customer.phone' => 'required_if:delivery.slug,yandex|nullable|required_without:customer.email|min:9|max:15',
            'customer.email' => 'nullable|required_without:customer.phone|email',
        ];
    }

    public function messages()
    {
        return [
            'customer.name.required' => 'Представьтесь, пожалуйста.',
            'customer.email.required_without' => 'Оставьте для обратной связи либо Email либо номер телефона.',
            'customer.phone.required_without' => 'Оставьте для обратной связи либо Email либо номер телефона.',
            'customer.phone.required_if' => 'Оставьте номер своего мобильного телефона. На него придет сообщение о доставке посылки.',
            'customer.phone.min' => 'Оставьте корректный номер телефона.',
            'customer.phone.max' => 'Оставьте корректный номер телефона.',
        ];
    }
}
