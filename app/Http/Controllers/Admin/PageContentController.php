<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\PageContent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;

class PageContentController extends AdminController
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
    public function store(Request $request)
    {
        //
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
        $pageContent = PageContent::findOrFail($id);
        return view('admin.page-content.edit', compact('pageContent'));
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
//        $pageContentTranslationData = [
//            'en' => [
//                'title' => $request->input('en_title'),
//                'description' => $request->input('en_description')
//            ],
//            'ru' => [
//                'title' => $request->input('ru_title'),
//                'description' => $request->input('ru_description')
//            ],
//            'hy' => [
//                'title' => $request->input('hy_title'),
//                'description' => $request->input('hy_description')
//            ],
//        ];

//        if ($request->hasFile('image')) {
//            if ($request->file('image')->isValid()) {
//
//                $this->validate($request, [
//                    'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:5000',
//                ]);
//            }
//            $image = $request->file('image');
//            $input['imagename'] = time().'.'.$image->extension();
//            $destinationPath = storage_path('app/public/page-content');
//
//            File::isDirectory($destinationPath) or File::makeDirectory($destinationPath, 0777, true, true);
//
//            $img = Image::make($image->path());
//            $img->save($destinationPath.'/'.$input['imagename'], 90);
//
//            $pageContentTranslationData['image'] = $input['imagename'];
//        }

//        $pageContent = PageContent::findOrFail($id);
//        $input =

        if (!empty($request->input('en_title'))) {
            foreach ($request->input('en_title') as $key => $link) {
                $pageContents = PageContent::findOrFail($id);

                if (empty($pageContents)) {
                    $pageContents = new PageContent();
                }

                $pageContents->page_id = $request->input('page_id');
                $pageContents->save();

                foreach (['en', 'ru', 'hy'] as $locale) {
                    if(!empty($request->input("{$locale}_title")[$key])) {
                        $pageContents->translateOrNew($locale)->title = $request->input("{$locale}_title")[$key];
                    }

                    if(!empty($request->input("{$locale}_description")[$key])) {
                        $pageContents->translateOrNew($locale)->description = $request->input("{$locale}_description")[$key];
                    }
                }

                $pageContents->save();
            }
        }

//        $pageContent->update($pageContentTranslationData);

        return redirect()->route('admin.page-content.edit', $id);
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
