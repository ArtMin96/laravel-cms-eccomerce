<?php

namespace App\Http\Controllers\Admin;

use App\Banner;
use App\Page;
use Illuminate\Http\Request;

class PageController extends AdminController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pages = Page::whereNull('parent_id')->with('childrenPages')->get();

        return view('admin.page.index', compact('pages'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $pages = Page::active();

        return view('admin.page.create', compact('pages'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $page = new Page();
        $page->validate($request->all());

        // Page
        $pageTranslationData = [
            'en' => [
                'name' => $request->input('en_name')
            ],
            'ru' => [
                'name' => $request->input('ru_name')
            ],
            'hy' => [
                'name' => $request->input('hy_name')
            ],
            'alias' => $request->input('alias'),
            'parent_id' => $request->input('parent_id'),
            'sort_order' => $request->input('sort_order'),
        ];

        $resource = Page::create($pageTranslationData);

        // Banner
        $bannerTranslationData = [
            'en' => [
                'title' => '',
                'description' => '',
            ],
            'ru' => [
                'title' => '',
                'description' => '',
            ],
            'hy' => [
                'title' => '',
                'description' => '',
            ],
            'image' => '',
            'page_id' => $resource->id,
        ];

        Banner::create($bannerTranslationData);

        return redirect()->route('admin.page.edit', $resource->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $page = Page::find($id);
        $pages = Page::active();
        return view('admin.page.edit', compact('page', 'pages'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $page = new Page();
        $page->validate($request->all());

        $pageTranslationData = [
            'en' => [
                'name' => $request->input('en_name')
            ],
            'ru' => [
                'name' => $request->input('ru_name')
            ],
            'hy' => [
                'name' => $request->input('hy_name')
            ],
            'alias' => $request->input('alias'),
            'parent_id' => $request->input('parent_id'),
            'sort_order' => $request->input('sort_order'),
        ];

        $resource = Page::findOrFail($id);
        $resource->update($pageTranslationData);

        return redirect()->route('admin.page.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
