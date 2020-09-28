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
        $rules = RuleFactory::make([
            '%title%' => 'required|string',
            '%description%' => 'required|string',
            'image' => 'file|max:5000|mimes:png,jpg,jpeg,gif',
        ]);
        $request->validate($rules);
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
