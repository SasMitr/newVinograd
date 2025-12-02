<?php

namespace App\Http\Controllers\Admin\Vinograd\Exel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\View;

class UpdateCatalogController extends Controller
{
    public function __construct()
    {
        View::share ('exel_active', ' active');
        View::share ('exel_open', ' menu-open');
    }

    public function index()
    {
        return view('admin.vinograd.exel.index');
    }

    public function import(Request $request)
    {
        Storage::putFileAs('exel', $request->file('file'), 'catalog.xlsx');
        return redirect()->back()->with('status', 'Файл загружен, обработка начата');
    }

    public function export()
    {
        Storage::download('exel/catalog.xlsx', 'Обновление каталога');
        return redirect()->back()->with('status', 'Файл скачался');
    }
}
