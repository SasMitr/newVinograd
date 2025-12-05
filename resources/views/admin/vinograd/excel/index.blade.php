@extends('admin.layouts.layout')

@section('title', 'Admin | Excel-обновление каталога')
@section('key', 'Admin | Excel-обновление каталога')
@section('desc', 'Admin | Excel-обновление каталога')

@section('header-title', 'Excel-обновление каталога')

@section('content')

    <div class="col-6">
        <a href="{{route('excel.export', ['modification_id' => 3])}}" class="btn btn-info btn-sm">Скачать файл каталога для саженцев</a>
    </div>

    <div class="col-6">
        <a href="{{route('excel.export', ['modification_id' => 1])}}" class="btn btn-info btn-sm">Скачать файл каталога для черенков</a>
    </div>

    <div class="col-6">
        <form action="{{route('excel.import')}}" method="POST" enctype="multipart/form-data" class=" mt-5">
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
