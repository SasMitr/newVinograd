<?php

namespace App\Http\Requests\Vinograd;

use Illuminate\Foundation\Http\FormRequest;

class CheckoutRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'customer' => array_merge(
                $this->customer,
                [
                    'phone' => preg_replace("/[^\d]/", '', $this->input('customer.phone')),
                    'otherPhone' => preg_replace("/[^\d]/", '', $this->input('customer.otherPhone')),
                ]
            ),
        ]);
    }

    public function rules()
    {
        return [
            'delivery.address' => 'sometimes|string',
            'delivery.index' => 'sometimes|regex:/^[0-9]{6}$/',
            'delivery.slug' => 'exists:vinograd_delivery_methods,slug',
            'customer.name' => 'required|min:3|max:50|string',
            'customer.phone' => 'required_if:delivery.slug,yandex|nullable|required_without:customer.email|min:9|max:15',
            'customer.otherPhone' => 'nullable|min:9|max:15',
            'customer.email' => 'nullable|required_without:customer.phone|email',
            'note' => 'nullable|string',
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
            'customer.otherPhone.min' => 'Оставьте корректный номер телефона.',
            'customer.otherPhone.max' => 'Оставьте корректный номер телефона.',
            'delivery.index.regex'  => 'Введите индекс почты правильного формата.',
            'delivery.address.string'  => 'Укажите действительный адрес отправки заказа.',
            'delivery.slug.exists'  => 'Что-то пошло не так, попробуйте снова.',
        ];
    }
}
