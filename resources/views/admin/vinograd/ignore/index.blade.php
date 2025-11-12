@extends('admin.layouts.layout')

@section('title', 'Admin | Список заблокированных')
@section('key', 'Admin | Список заблокированных')
@section('desc', 'Admin | Список заблокированных')

@section('header-title', 'Список заблокированных')

@section('content')
    <div class="col">
        <div class="form-group">
            <a href="{{route('ignores.create')}}" class="btn btn-success">Добавить в игнор</a>
        </div>
        <div class="table-responsive">
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>Дата</th>
                    <th>Телефон</th>
                    <th>Email</th>
                    <th>Примечание</th>
                    <th>Статус</th>
                </tr>
                </thead>
                <tbody>
                @foreach($ignores as $i=>$item)
                    <tr>
                        <td>{{getRusDate($item->date_at)}}</td>
                        <td>{{$item->phone}}</td>
                        <td>{{$item->email}}</td>
                        <td>{{$item->note}}</td>
                        <td>
                            <div class="btn-group" id="nav">
                                @if($item->is_blocked)
                                    <a class="btn btn-outline-warning btn-sm" href="{{route('ignores.toggle', ['id' => $item->id])}}" role="button"><i class="fa fa-lock"></i></a>
                                @else
                                    <a class="btn btn-outline-success btn-sm" href="{{route('ignores.toggle', ['id' => $item->id])}} role="button"><i class="fa fa-thumbs-o-up"></i></a>
                                @endif
                                <a href="{{route('ignores.edit', $item->id)}}" class="btn btn-outline-primary btn-sm" role="button"><i class="fa fa-pencil"></i></a>
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        {{--{{$ignores->links('admin.components.pagination')}}--}}
    </div>
@endsection
