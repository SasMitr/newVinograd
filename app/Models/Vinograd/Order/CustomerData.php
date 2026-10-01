<?php

namespace App\Models\Vinograd\Order;
class CustomerData
{
    public $phone;
    public $name;
    public $email;
    public $otherPhone;

    public function __construct($phone = '', $name = '', $email = '', $otherPhone = '')
    {
        $this->phone = $phone;
        $this->name = $name;
        $this->email = $email;
        $this->otherPhone = $otherPhone;
    }
}
