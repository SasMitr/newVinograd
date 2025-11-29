<?php

namespace App\Http\Controllers\Admin\Vinograd;

use App\Http\Controllers\Controller;
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

    public function store(Request $request)
    {
        Ignore::add($request);
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

    public function blocked(Request $request, $order_id)
    {
        $order = Order::find($order_id);
        $item = Ignore::query()->where('phone', ignorPhone($order->customer['phone']))->orWhere('email', $order->customer['email'])->first();
        if ($item->exists()) {
            return [
                'success' => view('admin.vinograd.ignore.components._form', ['item' => $item])->render()
            ];
        } else {
            return [ 'success' => ['ok-else']];
        }
//        Ignore::updateOrInsert(
//            ['phone' => ignorPhone($order->customer['phone']), 'email' => $order->customer['email']],
//            ['date_at' => time()]
//        );
//        return redirect()->back();
    }

    public function toggle($id)
    {
        $item = Ignore::find($id);
        $item->toggleStatus();

        return redirect()->back();
    }
}
