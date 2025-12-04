@extends('admin.layouts.layout')

@section('title', 'Admin | Exel-обновление каталога')
@section('key', 'Admin | Exel-обновление каталога')
@section('desc', 'Admin | Exel-обновление каталога')

@section('header-title', 'Exel-обновление каталога')

@section('content')

    <div class="col-6">
        <a href="{{route('exel.export', ['modification_id' => 3])}}" class="btn btn-info btn-sm">Скачать файл каталога для саженцев</a>
    </div>

    <div class="col-6">
        <a href="{{route('exel.export', ['modification_id' => 1])}}" class="btn btn-info btn-sm">Скачать файл каталога для черенков</a>
    </div>

    <div class="col-6">
        <form action="{{route('exel.import')}}" method="POST" enctype="multipart/form-data" class=" mt-5">
            @csrf
            <div class="form-group">
                <label for="exampleInputFile">Загрузить файл exel обновления каталога</label>
                <div class="input-group">
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="exampleInputFile" name="file">
                        <label class="custom-file-label" for="exampleInputFile">Загрузить файл</label>
                    </div>
                </div>
            </div>
            <button class="btn btn-success">Добавить</button>
        </form>
    </div>

@endsection
