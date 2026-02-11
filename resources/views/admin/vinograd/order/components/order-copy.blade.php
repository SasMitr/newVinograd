----------------------------------
@foreach ($items as $item)
@php $item->setRelation('order', $order) @endphp

{{$item->product_name}}       {{$item->quantity}}шт x {{mailCurr($currency, $item->price)}}{{$currency->sign}} = {{mailCurr($currency, $item->getCost())}}{{$currency->sign}}
{{$item->modification_name}}
@endforeach
----------------------------------

Общее количество:
@foreach ($quantityByModifications as $name => $value)
{{$name}}: {{$value}}шт
@endforeach
----------------------------------

Стоимость заказа:  {{mailCurr($currency, $order->cost)}} {{$currency->sign}}
{{$order->delivery['method_name']}}: Вес- {{$order->delivery['weight'] / 1000}}кг.  {{mailCurr($currency, $order->delivery['cost'])}} {{$currency->sign}}

Итоговая стоимость: {{mailCurr($currency, $order->getTotalCost())}} {{$currency->sign}}
