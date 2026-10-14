@extends('admin.vinograd.analytica.dashboard')

@section('title', 'Admin | Архив')
@section('key', 'Admin | Архив')
@section('desc', 'Admin | Архив')

@section('header')
    @parent

    <link rel="stylesheet" href="/css/dataTables.bootstrap4.css">
@endsection

@section('content')

    <div class="col">
        <h2 class="p-4">
            Архивные заказы.
            <small>{!! $titleDate !!}</small>
        </h2>
        <h4>Вывод формируется по дате создания, исключаются отмененные заказы. Исходя из чего показатели не совсем корректны.</h4>
        <div class="card">
            <div class="card-header">
                @include('admin.vinograd.analytica._periodpicker', ['route' => 'dashboard.archive'])

                <div class="card-tools">
                    <h3 class="card-title">Итого: <b>{{$totalCost}}</b> руб</h3>
                </div>
            </div>
            <div class="card-body table-responsive">

                <div class="row mb-5">
                    <div class="col-12 col-sm-4">
                        <div class="info-box bg-light">
                            <div class="info-box-content">
                                <span class="info-box-text text-center text-muted">Колличество заказов</span>
                                <span class="info-box-number text-center text-muted mb-0">{{$orderCount}}</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-4">
                        <div class="info-box bg-light">
                            <div class="info-box-content">
                                <span class="info-box-text text-center text-muted">Средний чек</span>
                                <span class="info-box-number text-center text-muted mb-0">{{$orderAVG}}</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-4">
                        <div class="info-box bg-light">
                            <div class="info-box-content">
                                <span class="info-box-text text-center text-muted">Придумаю потом</span>
                                <span class="info-box-number text-center text-muted mb-0"> ? <span>
                    </span></span></div>
                        </div>
                    </div>
                </div>

                <table id="example1" class="table table-condensed">
                    <thead>
                    <tr>
                        <th>Название</th>
                        <th>Модификации</th>
                        <th>Кол-во</th>
                        <th>Цена</th>
                        <th>Сумма</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($array as $productName => $modifications)
                        <tr>
                            <td>{{$productName}}</td>

                            <td class="p-0"><ul class="list-group list-group-flush">
                        @foreach($modifications as $modification)
                            <li class="list-group-item">{{$modification->modification_name}}</li>
                        @endforeach
                            </ul></td>

                            <td class="p-0"><ul class="list-group list-group-flush">
                        @foreach($modifications as $modification)
                            <li class="list-group-item"><b>{{$modification->allQuantity}}</b> шт</li>
                        @endforeach
                            </ul></td>

                            <td class="p-0"><ul class="list-group list-group-flush">
                        @foreach($modifications as $modification)
                            <li class="list-group-item"><b>{{$modification->price}}</b> руб</li>
                        @endforeach
                            </ul></td>

                            <td class="p-0"><ul class="list-group list-group-flush">
                        @foreach($modifications as $modification)
                            <li class="list-group-item"><b>{{$modification->cost}}</b> руб</li>
                        @endforeach
                            </ul></td>

                            <td class="p-0"><ul class="list-group list-group-flush">
                        @foreach($modifications as $modification)
                            <li class="list-group-item"><a class="btn btn-block btn-outline-secondary btn-sm" href="{{route('dashboard.orders_as_modification', ['product_id' => $modification->product_id, 'modification_id' => $modification->modification_id, 'price' => $modification->price, request()->getQueryString()])}}" role="button">Показать в заказах</a></li>
                        @endforeach
                            </ul></td>

                    </tr>
                    @empty
                        <tr>
                            <td><h3>Нет продаж</h3></td><td></td><td></td><td></td><td></td>
                        </tr>
                    @endforelse





{{--                    @forelse($array as $productName => $modifications)--}}
{{--                        <tr>--}}
{{--                            <td rowspan="{{$modifications->count()}}">{{$productName}}</td>--}}
{{--                        @foreach($modifications as $modification)--}}

{{--                        @if(!$loop->first)--}}
{{--                            <tr>--}}
{{--                        @endif--}}

{{--                                    <td>{{$modification->modification_name}}</td>--}}
{{--                                    <td><b>{{$modification->allQuantity}}</b> шт</td>--}}
{{--                                    <td><b>{{$modification->price}}</b> руб</td>--}}
{{--                                    <td><b>{{$modification->cost}}</b> руб</td>--}}
{{--                                    <td>--}}
{{--                                        <a class="btn btn-block btn-outline-secondary btn-sm" href="{{route('dashboard.orders_as_modification', ['product_id' => $modification->product_id, 'modification_id' => $modification->modification_id, 'price' => $modification->price, request()->getQueryString()])}}" role="button">Показать в заказах</a>--}}
{{--                                    </td>--}}

{{--                                    @if(!$loop->last)--}}
{{--                                </tr>--}}
{{--                                @endif--}}

{{--                                @endforeach--}}

{{--                                </tr>--}}
{{--                                @empty--}}
{{--                                    <tr>--}}
{{--                                        <td colspan="5"><h3>Нет продаж</h3></td>--}}
{{--                                    </tr>--}}
{{--                                @endforelse--}}
                    </tbody>
                </table>

                <table id="example2" class="table table-condensed">
                </table>

            </div>
            <div class="card-footer text-right">
                <h3 class="card-title">Итого: <b>{{$totalCost}}</b> руб</h3>
            </div>
        </div>
    </div>

@endsection

@section('scripts')
    @parent

    <script src="/js/jquery.dataTables.js"></script>
    <script src="/js/dataTables.bootstrap4.js"></script>

    <script>
        $(function () {
            $('#example1').DataTable({
                "paging": true,
                "lengthChange": true,
                "searching": true,

                //  сортировка по первому столбцу: включение/выключение
                "ordering": false,
                // "aaSorting": [[ 0, "asc" ]],
                // "ordering": true,

                "info": false,
                "stateSave": true,
                "iDisplayLength": 20,
                "aLengthMenu": [[ 10, 20, 50, 100 ,-1],[10,20,50,100,"все"]],

                //"autoWidth": false,
                "language": {
                    "processing": "Подождите...",
                    "search": "Поиск:",
                    "lengthMenu": "Показывать по  _MENU_  записей",
                    "info": "Записи с _START_ до _END_ из _TOTAL_ записей",
                    "infoEmpty": "Записи с 0 до 0 из 0 записей",
                    "infoFiltered": "(отфильтровано из _MAX_ записей)",
                    "infoPostFix": "",
                    "loadingRecords": "Загрузка записей...",
                    "zeroRecords": "Записи отсутствуют.",
                    "emptyTable": "В таблице отсутствуют данные",
                    "paginate": {
                        "first": "Первая",
                        "previous": "Предыдущая",
                        "next": "Следующая",
                        "last": "Последняя"
                    },
                },
                "columnDefs": [ //  Исключаем из поиска столбцы
                    {
                        "targets": [ 1 ],
                        "searchable": false
                    },
                    {
                        "targets": [ 2 ],
                        "searchable": false
                    },
                    {
                        "targets": [ 3 ],
                        "searchable": false
                    },
                    {
                        "targets": [ 4 ],
                        "searchable": false
                    }
                ]
            });
        });
    </script>

@endsection
