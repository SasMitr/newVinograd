@extends('admin.vinograd.analytica.dashboard')

@section('title', 'Admin | Избранные номера заказов')
@section('key', 'Admin | Избранные номера заказов')
@section('desc', 'Admin | Избранные номера заказов')

@section('content')
    <div class="col">
        <h2>Избранные номера заказов</h2>
        <div class="card">
            <div class="card-header">
                <form action="?" method="GET">
                    <div class="form-group">
                        <label>Ввести номера заказов (разделять пробелом, запятой, точкой, переводом строки.)</label>
                        <textarea name="ids" class="form-control" rows="3" placeholder="Введите номера избранных заказов!">{{$select_numbers ?: ''}}</textarea>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Показать</button>
                    </div>
                </form>
            </div>
            <div class="card-body table-responsive">
                <table class="table table-condensed">
                    <tbody>
                    @forelse($orders as $modificationName => $products)
                        <tr>
                            <td colspan="2"><h4 class="text-center">{{$modificationName}}</h4></td>
                        </tr>
                        @foreach($products as $product)
                            <tr>
                                <td>{{$product->product_name}}</td>
                                <td><b>{{$product->allQuantity}}</b> шт</td>
                            </tr>
                        @endforeach
                    @empty
                        <tr>
                            <td colspan="5"><h3>Нет продаж</h3></td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>

                @if($orders)
                <a href="{{route('dashboard.print.select_orders', ['ids' => $select_numbers])}}" target="_blank" class="btn btn-primary">
                    <i class="fa fa-print"></i>
                    Распечатать список
                </a>
                @endif

            </div>
            <div class="card-footer text-right">
            </div>
        </div>
    </div>
@endsection
