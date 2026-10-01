<?php

namespace App\Http\Controllers\Admin\Vinograd\Order;

use App\Http\Controllers\Controller;
use App\Models\Vinograd\Currency;
use App\Models\Vinograd\Order\Order;
use App\Models\Vinograd\Order\OrderItem;

class OrderCopyController extends Controller
{
    public function __invoke(Order $order)
    {
        try {
            $items = OrderItem::getOrderSortedByItems($order);
            $quantityByModifications = OrderItem::getQuantityByModifications($items);
            $currency = Currency::where('code', $order->currency)->first();

            return [
                'success' =>  view('admin.vinograd.order.components.order-copy', compact('items', 'quantityByModifications', 'order', 'currency'))->render(),
            ];

        } catch (\Exception $e) {
            return ['errors' => [$e->getMessage()]];
        }
    }
}
