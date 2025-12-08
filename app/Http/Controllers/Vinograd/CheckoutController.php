<?php

namespace App\Http\Controllers\Vinograd;

use App\Http\Requests\Vinograd\CheckoutRequest;
use App\Models\Vinograd\DeliveryMethod;
use App\UseCases\CartService;
use App\UseCases\OrderService;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;

class CheckoutController extends Controller
{
    public $service;
    public $cartService;

    public function __construct(CartService $cartService, OrderService $service)
    {
        $this->cartService = $cartService;
        $this->service = $service;
        View::share ('cart', $cartService->getCart());
    }

    public function delivery()
    {
        return view('vinograd.checkout.delivery', [
                'deliverys' => DeliveryMethod::select('name', 'slug')->active()->filterCost($this->cartService->getCart()->getCost()->getTotal())->orderBy('sort')->get(),
                'cart' => $this->cartService->getCart()
            ]);
    }

    public function deliveryForm($delivery_slug)
    {
        return view('vinograd.checkout.order-confirmation', [
            'delivery' => DeliveryMethod::where('slug', $delivery_slug)->first()
        ]);
    }

    public function orderConfirmation($delivery_slug)
    {
        return view('vinograd.checkout.checkoutForm', [
            'delivery' => DeliveryMethod::where('slug', $delivery_slug)->first()
        ]);
    }

    public function checkout(CheckoutRequest $request)
    {
        try {
            $this->service->isIgnore($request);
            $order = $this->service->checkout($request);
            $this->service->sendMail($order);

            return redirect()->
                   route((Auth::user()) ? 'vinograd.cabinet.home' : 'vinograd.category')->
                   with('status', 'Заказ сохранен. № заказа: ' . $order->id . '. Саженцы будут готовы на конец октября - начало ноября, черенки на конец ноября начало декабря. Как только все будет готово, мы с Вами свяжемся для уточнения деталей!')->
                   withErrors(['<h4>ВНИМАНИЕ! Если от нас не поступает обратная связь, посмотрите письма в папке СПАМ</h4>']);

        } catch (\DomainException $e) {
            return redirect()->route('vinograd.cart.ingex')->withErrors([$e->getMessage()]);
        }
    }
}
