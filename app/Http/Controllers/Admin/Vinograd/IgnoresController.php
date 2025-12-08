<?php

namespace App\Http\Controllers\Admin\Vinograd;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Vinograd\Order\CustomerBlockedRequest;
use App\Models\Vinograd\Ignore;
use App\Models\Vinograd\Order\Order;
use Illuminate\Http\Request;
use View;

class IgnoresController extends Controller
{
    public function __construct()
    {
        View::share ('ignores_active', ' active');
        View::share ('ignores_open', ' menu-open');
    }

    public function index()
    {
        return view('admin.vinograd.ignore.index', [
            'ignores' => Ignore::query()->get()
        ]);
    }

    public function create()
    {
        return view('admin.vinograd.ignore.create');
    }

    public function store(CustomerBlockedRequest $request)
    {
        $item = Ignore::isIgnore($request->email, $request->phone)->first();
        !$item ? Ignore::add($request) : $item->edit($request);

        return redirect()->route('ignores.index');
    }

    public function edit($id)
    {
        return view('admin.vinograd.ignore.edit', [
            'item' => Ignore::find($id)
        ]);
    }

    public function update(Request $request, $id)
    {
        $item = Ignore::find($id);

        $item->edit($request);
        return redirect()->route('ignores.index');
    }

    public function blockedForm($order_id)
    {
        $order = Order::find($order_id);
        $item = Ignore::isIgnore($order->customer['email'], $order->customer['phone'])->first();
            return [
                'success' => view('admin.vinograd.ignore.components._form', [
                    'phone' => $item ? $item->phone : $order->customer['phone'],
                    'email' => $item ? $item->email : $order->customer['email'],
                    'note' => $item ? $item->note : '',
                    'ignor_id' => $item ? $item->id : ''
                ])->render()
            ];
    }

    public function blockedStore(CustomerBlockedRequest $request)
    {
        if (!$request->ignor_id) {
            Ignore::add($request);
        } else {
            $item = Ignore::find($request->ignor_id);
            $item->edit($request, true);
        }

         return [
             'success' => 'работает'
         ];
    }

    public function toggle($id)
    {
        $item = Ignore::find($id);
        $item->toggleStatus();

        return redirect()->back();
    }
}
