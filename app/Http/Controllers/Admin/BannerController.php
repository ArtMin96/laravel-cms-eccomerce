<?php

namespace App\Http\Controllers\Admin;

use App\Banner;
use App\Page;
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
        // Banner
        $bannerTranslationData = [
            'en' => [
                'title' => $request->input('en_title'),
                'description' => $request->input('en_description')
            ],
            'ru' => [
                'title' => $request->input('ru_title'),
                'description' => $request->input('ru_description')
            ],
            'hy' => [
                'title' => $request->input('hy_title'),
                'description' => $request->input('hy_description')
            ],
        ];

        if ($request->hasFile('image')) {
            if ($request->file('image')->isValid()) {

                $this->validate($request, [
                    'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:5000',
                ]);
            }
            $image = $request->file('image');
            $input['imagename'] = time().'.'.$image->extension();
            $destinationPath = storage_path('app/public/banner');

            File::isDirectory($destinationPath) or File::makeDirectory($destinationPath, 0777, true, true);

            $img = Image::make($image->path());
            $img->save($destinationPath.'/'.$input['imagename'], 90);

            $bannerTranslationData['image'] = $input['imagename'];
        }

        $banner = Banner::findOrFail($id);
        $banner->update($bannerTranslationData);

        return redirect()->route('admin.banner.edit', $id);
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
