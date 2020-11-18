<?php

namespace App\Http\Controllers\Admin;

use App\Banner;
use App\Page;
use App\PageContent;
use App\Seo;
use Astrotomic\Translatable\Validation\RuleFactory;
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
        $pages = Page::with('childrenPages')->get();

        return view('admin.page.index', compact('pages'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $pages = Page::activeAcceptedParents();

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

        $rules = RuleFactory::make([
            '%name%' => 'required|string',
        ]);
        $request->validate($rules);
        $request->validate([
            'alias' => 'required|string',
            'sort_order' => 'numeric|min:0|max:600',
        ]);

        $resource = Page::create($request->all());

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
        PageContent::create(['page_id' => $resource->id]);
        Seo::create(['page_id' => $resource->id]);

        return redirect()
            ->route('admin.page.index')
            ->with('success', __('admin.page_created_successfully'));
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
        $pages = Page::activeAcceptedParents();
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

        $rules = RuleFactory::make([
            '%name%' => 'required|string',
            'alias' => 'required|string',
            'sort_order' => 'numeric|min:0|max:600',
        ]);
        $request->validate($rules);

        $resource = Page::findOrFail($id);
        $resource->update($request->all());

        return redirect()
            ->route('admin.page.index')
            ->with('success', __('admin.page_updated_successfully'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $page = Page::with('childrenPages')->where('id', $request->id)->first();
        $pagesId = $page->childrenPages->pluck('parent_id');
        $page->childrenPages()->delete();
        $page->banners->delete();
        $page->seo->delete();
        Page::destroy($pagesId);

        if ($page->delete()) {
            return response()->json(['status' => true]);
        } else {
            return response()->json(['status' => false]);
        }
    }
}
