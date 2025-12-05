<?php

namespace App\Http\Controllers\Admin\Vinograd\Exel;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Vinograd\Excel\CatalogImportRequest;
use Illuminate\Support\Facades\View;
use App\Exports\CatalogExport;
use App\Imports\CatalogImport;
use Maatwebsite\Excel\Facades\Excel;

class UpdateCatalogController extends Controller
{
    public function __construct()
    {
        View::share ('excel_active', ' active');
        View::share ('excel_open', ' menu-open');
    }

    public function index()
    {
        return view('admin.vinograd.excel.index');
    }

    public function import(CatalogImportRequest $request)
    {
	    Excel::import(new CatalogImport, $request->file('file'));
        //Storage::putFileAs('excel', $request->file('file'), 'catalog.xlsx');
        return redirect()->back()->with('status', 'Файл загружен, обработка начата');
    }

    public function export($modification_id)
    {
        $modification_name = $modification_id == 1 ? 'cherenki' : 'sagenzi';
	    return Excel::download(new CatalogExport ($modification_id), 'catalog_' . $modification_name . '.xlsx');
    }
}
