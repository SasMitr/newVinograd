@extends('layouts.vinograd-left')

@section('title', 'Подтверждение заказа')
@section('key', 'Подтверждение заказа')
@section('desc', 'Подтверждение заказа')

@section('head')
    {{Html::meta('robots', 'noindex, nofollow')}}
@endsection

@section('breadcrumb-content')
    <li><a href="{{route('vinograd.checkout.delivery')}}">Доставка</a></li>
    <li class="active">Важная информация</li>
@endsection

@section('left-content')
    <div class="checkout-area mb-80">
        <div class="container">

            <div class="card border-secondary">
                <div class="card-header">
                    <h3 class="card-title">Важно, ознакомьтесь с информацией прежде чем продолжить оформление</h3>
                </div>
                <div class="card-body">

                    <p class="card-text">Здравствуйте.</p>
                    <p class="card-text">Саженцы из школки, планируем выкапывать в конце октября – начале ноября, когда вызреет лоза и опадет лист.
                        Сроки выкопки могут сдвинуться в зависимости от вызревания саженцев.
                    </p>
                    <p class="card-text">На данном этапе не можем гарантировать наличие всех саженцев в заказа, все  зависит от вызревания.</p>
                    @if($delivery->isMailed())
                        <p class="card-text">С почтой работаем по предоплате (оплата на карту). Согласование и оплата только после выкопки саженцев, когда мы будем точно уверены в полноте выполнения вашего заказа.</p>
{{--                    @elseif ($delivery->isPickup())--}}
{{--                        <p class="card-text">Инфа по самовывозу.</p>--}}
                    @endif

                    <p class="card-text">Как только все будет готово, мы с вами свяжемся.</p>
                    <p class="card-text">
                        <a href="https://vinograd-minsk.by/page/garantii-i-usloviia-vozvrata.html" class="btn btn-outline-primary">Ознакомтесь с гарантийными обязательствами и условиями возврата.</a>
                    </p>
                    <a href="https://youtu.be/i5SCn1MhnD8" class="btn btn-outline-primary">Здесь подробная информация о наших саженцах</a>
                </div>
            </div>

            <div class="mt-5 card border-dark bg-light">
                <div class="card-header">
                    <h3 class="card-title">Тип доставки - {{$delivery->name}}</h3>
                </div>
                <div class="card-body">
{{--                    <h3 class="card-title">Тип доставки - {{$delivery->name}}</h3>--}}
                    <p class="card-text">{!! $delivery->content !!}</p>
                </div>
            </div>
        </div>
        <a href="{{route('vinograd.checkout.order.confirmation', ['delivery_slug' => $delivery->slug])}}" class="mt-5 btn btn-success btn-lg btn-block">
            Перейти к оформлению заказа
        </a>
    </div>
@endsection
