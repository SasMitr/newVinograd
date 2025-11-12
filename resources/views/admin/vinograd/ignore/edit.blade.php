@extends('admin.layouts.layout')

@section('title', 'Admin | Редактировать игнор')
@section('key', 'Admin | Редактировать игнор')
@section('desc', 'Admin | Редактировать игнор')

@section('header-title', 'Редактировать игнор')

@section('content')
    <div class="col">
        {!! Form::open(['route' => ['ignores.update', $item->id], 'method' => 'patch']) !!}
        <div class="form-group">
            <label for="name">Название (В меню)</label>
            <input type="text" class="form-control" id="phone" name="phone" value="{{old('phone', $item->phone)}}">
        </div>
        <div class="form-group">
            <label for="slug">Алиас</label>
            <input type="text" class="form-control" id="email" name="email" value="{{old('email', $item->email)}}">
        </div>
        <div class="form-group">
            <label for="text">Текст</label>
            <textarea name="note" id="content" class="form-control">{{old('note', $item->note)}}</textarea>
        </div>
        <div class="box-footer">
            <button class="btn btn-success">Сохранить</button>
        </div>
        {!! Form::close() !!}
    </div>
@endsection
