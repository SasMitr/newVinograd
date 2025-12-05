<?php

namespace App\Repositories;

use App\Models\Vinograd\Order\Order;
use App\Models\Vinograd\Order\Order as Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class OrderRepository extends CoreRepository
{
    public function getModelClass()
    {
        return Model::class;
    }

    /**
     * @param int $id
     *
     * @return Model
     */
    public function getEdit($id)
    {
        return $this->modelName()->find($id);
    }

    public function getFilterOrders(Request $request, $status)
    {
        return Order::when($request->query(),
            function (Builder $query) use ($request, $status) {
                $query->
                when($request->id, function (Builder $query) use ($request) {
                    $query->orWhere('id', $request->id);
                })->
                when($request->email, function (Builder $query) use ($request) {
                    $query->orWhere('customer', 'like', '%' . $request->email . '%');
                })->
                when($request->phone, function (Builder $query) use ($request) {
                    $query->orWhere('customer', 'like', '%' . preg_replace("/[^\d]/", '', $request->phone) . '%');
                })->
                when($request->build, function (Builder $query) use ($request) {
                    $query->orWhere('date_build', $request->build);
                });
            },
            function (Builder $query) use ($status) {
                $query->status($status);
            })->
        orderBy('current_status')->
        orderBy('id', 'desc')->
        paginate(30)->
        appends($request->all());
    }

    //######################################

    public function get($id): Order
    {
        $order = Order::with('items')->find($id);
        if (!$order) {
            throw new \RuntimeException('Order is not found.');
        }
        return $order;
    }

    public function save(Order $order): void
    {
        if (!$order->save()) {
            throw new \RuntimeException('Saving error.');
        }
    }

    public function remove(Order $order): void
    {
        if (!$order->delete()) {
            throw new \RuntimeException('Removing error.');
        }
    }

    public function isCompleted(Order $order): void
    {
        if ($order->isCompleted()) {
            throw new \RuntimeException('Заказ закрыт.');
        }
    }
}
