@extends('admin.layouts.layout')

@section('title', 'Admin | Печать. Избранные номера заказов')
@section('key', 'Admin | Печать. Избранные номера заказов')
@section('desc', 'Admin | Печать. Избранные номера заказов')

@section('header-title', 'Печать. Избранные номера заказов')

@section('body-print', ' onload=window.print();')

@section('content')

    <div class="col-6">
        <div class="card">
            <div class="card-body table-responsive">
                <table class="table table-sm table-condensed">
                    <tbody>
                    @foreach($orders as $modificationName => $products)
                        <tr>
                            <td colspan="2"><h4 class="text-center">{{$modificationName}}</h4></td>
                        </tr>
                        @foreach($products as $product)
                            <tr>
                                <td>{{$product->product_name}}</td>
                                <td><b>{{$product->allQuantity}}</b> шт</td>
                            </tr>
                        @endforeach
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection
