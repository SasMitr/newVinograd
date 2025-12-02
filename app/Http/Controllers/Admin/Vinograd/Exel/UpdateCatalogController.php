<?php

namespace App\Http\Controllers\Admin\Vinograd\Exel;

use App\Http\Controllers\Controller;
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

    public function import()
    {

    }

    public function export()
    {

    }
}
