<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\PageContent;
use Astrotomic\Translatable\Validation\RuleFactory;
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
//        dd($request);
//        $rules = RuleFactory::make([
//            '%title%' => 'required|string',
//            '%description%' => 'required|string',
//            'image' => 'file|max:5000|mimes:png,jpg,jpeg,gif',
//        ]);
//        $request->validate($rules);
        $inputs = $request->all();

        if ($request->hasFile('image')) {

            $image = $request->file('image');
            $input['imagename'] = time().'.'.$image->extension();
            $destinationPath = storage_path('app/public/page-content');

            File::isDirectory($destinationPath) or File::makeDirectory($destinationPath, 0777, true, true);

            $img = Image::make($image->path());
            $img->save($destinationPath.'/'.$input['imagename'], 90);

            $inputs['image'] = $input['imagename'];
        }

        if (!empty($inputs['has_link'])) {
            foreach ($inputs['has_link'] as $key => $hasLink) {
                if ($hasLink == 'on') {
                    $pageContent = PageContent::where('page_id', $id)->first();

                    if (empty($pageContent)) {
                        $pageContent = new PageContent();
                    }

                    $pageContent->page_id = $inputs['page_id'][$key];
                    $pageContent->has_link = 1;
                    $pageContent->button_type = !empty($inputs['button_type'][$key])? $inputs['button_type'][$key] : 0; // Validate required_if has link
                    $pageContent->url = $inputs['url'][$key];
                    $pageContent->save();

                    foreach (['en', 'ru', 'hy'] as $locale) {
                        if(!empty($request->input("link_title")[$key])){
                            $pageContent->translateOrNew($locale)->link_title = $request->input("link_title")[$key];
                        }
                    }
                }
            }
        }

        $pageContent = PageContent::findOrFail($id);
        $pageContent->update($inputs);

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
