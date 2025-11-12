<?php

namespace App\Http\Controllers\Admin\Vinograd;

use App\Models\Vinograd\Ignore;
use Illuminate\Http\Request;
use View;

class IgnoresController extends AppController
{
    public function __construct()
    {
        parent::__construct();
        View::share ('ignores_active', ' active');
    }

    public function index()
    {
        return view('admin.vinograd.ignore.index', [
            'ignores' => Ignore::query()->get()
        ]);
    }

    public function create()
    {
        return view('admin.vinograd.ignore.create');
    }

    public function store(Request $request)
    {
        $item = Ignore::add($request);

//        $page->toggleStatus($request->get('status'));

        try {
//            new PostContentService($page);
//            dispatch(new ContentProcessing($page));
//
//            dispatch(new SitemapVinograd());
//            cache()->delete('siteMapHTML');

        } catch (\Exception $e) {
            return back()->withErrors([$e->getMessage()]);
        }
        return redirect()->route('ignores.index');
    }

    public function edit($id)
    {
        return view('admin.vinograd.ignore.edit', [
            'item' => Ignore::find($id)
        ]);
    }

    public function update(Request $request, $id)
    {
        $item = Ignore::find($id);

        $item->edit($request);
//        $page->toggleStatus($request->get('status'));

//        try {
////            new PostContentService($page);
//////            dispatch(new ContentProcessing($page));
////
////            dispatch(new SitemapVinograd());
////            cache()->delete('siteMapHTML');
//
//        } catch (\Exception $e) {
//            return back()->withErrors([$e->getMessage()]);
//        }
        return redirect()->route('ignores.index');
    }

    public function toggle($id)
    {
        $item = Ignore::find($id);
        $item->toggleStatus();

        return redirect()->back();
    }
}
