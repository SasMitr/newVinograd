@extends('admin.layouts.layout')

@section('title', 'Admin | Добавить в игнор')
@section('key', 'Admin | Добавить в игнор')
@section('desc', 'Admin | Добавить в игнор')

@section('header-title', 'Добавить в игнор')

@section('content')
    <div class="col">
        {!! Form::open(['route' => 'ignores.store']) !!}
        <div class="row">


        <div class="col-6">
            <div class="form-group">
                <label for="name">Телефон</label>
                <input type="text" class="form-control" id="phone" name="phone" value="{{old('phone')}}">
            </div>
            <div class="form-group">
                <label for="title">Email</label>
                <input type="text" class="form-control" id="email" name="email" value="{{old('email')}}">
            </div>
        </div>
        <div class="col-6">
            <div class="form-group">
                <label for="text">Примечание</label>
                <textarea name="note" id="note" class="form-control" rows="4">{{old('note')}}</textarea>
            </div>
        </div>
        </div>

        <div class="box-footer">
            <button class="btn btn-success">Добавить</button>
        </div>
        {!! Form::close() !!}
    </div>
@endsection
