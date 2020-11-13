<?php

namespace App\Http\Controllers\Admin;

use App\Banner;
use App\BannerLinks;
use App\BannerLinksTranslation;
use App\Page;
use Astrotomic\Translatable\Validation\RuleFactory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;

class BannerController extends AdminController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $page_id)
    {
        $page = Page::findOfFail($page_id);

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
            'page_id' => $page_id,
        ];

        $page->banners()->create($bannerTranslationData);
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
        $banner = Banner::findOrFail($id);
        return view('admin.banner.edit', compact('banner'));
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
//        dd($request);
        $rules = RuleFactory::make([
            '%title%' => 'required',
            '%description%' => 'required',
        ]);
        $request->validate($rules);
        $request->validate([
            'image' => 'file|max:5000|mimes:png,jpg,jpeg,gif',
        ]);

        $inputs = $request->all();

        // Banner
        $bannerTranslationData = [
            'en' => [
                'title' => $request->input('en')['title'],
                'description' => $request->input('en')['description']
            ],
            'ru' => [
                'title' => $request->input('ru')['title'],
                'description' => $request->input('ru')['description']
            ],
            'hy' => [
                'title' => $request->input('hy')['title'],
                'description' => $request->input('hy')['description']
            ],
        ];

        if ($request->hasFile('image')) {

            $image = $request->file('image');
            $input['imagename'] = time().'.'.$image->extension();
            $destinationPath = storage_path('app/public/banner');

            File::isDirectory($destinationPath) or File::makeDirectory($destinationPath, 0777, true, true);

            $img = Image::make($image->path());
            $img->save($destinationPath.'/'.$input['imagename'], 90);

            $inputs['image'] = $input['imagename'];
        }

        $banner = Banner::findOrFail($id);
        $banner->update($inputs);

        return redirect()->route('admin.page.index')->with('success', __('admin.page_updated_successfully'));
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
