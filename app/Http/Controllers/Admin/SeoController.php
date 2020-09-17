<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Seo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;

class SeoController extends AdminController
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
        $seo = Seo::findOrFail($id);
        return view('admin.seo.edit', compact('seo'));
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

        $seo = Seo::findOrFail($id);

        if ($request->hasFile('meta_image')) {
            if ($request->file('meta_image')->isValid()) {

                $this->validate($request, [
                    'meta_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:5000',
                ]);
            }
            $image = $request->file('meta_image');
            $input['meta_image'] = time().'.'.$image->extension();
            $destinationPath = storage_path('app/public/seo');

            File::isDirectory($destinationPath) or File::makeDirectory($destinationPath, 0777, true, true);

            $img = Image::make($image->path());
            $img->save($destinationPath.'/'.$input['meta_image'], 90);

            $seo->meta_image = $input['meta_image'];
        }

        if ($request->hasFile('og_image')) {
            if ($request->file('og_image')->isValid()) {

                $this->validate($request, [
                    'og_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:5000',
                ]);
            }
            $image = $request->file('og_image');
            $input['og_image'] = time().'.'.$image->extension();
            $destinationPath = storage_path('app/public/seo');

            File::isDirectory($destinationPath) or File::makeDirectory($destinationPath, 0777, true, true);

            $img = Image::make($image->path());
            $img->save($destinationPath.'/'.$input['og_image'], 90);

            $seo->og_image = $input['og_image'];
        }

        if ($request->hasFile('twitter_image')) {
            if ($request->file('twitter_image')->isValid()) {

                $this->validate($request, [
                    'twitter_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:5000',
                ]);
            }
            $image = $request->file('twitter_image');
            $input['twitter_image'] = time().'.'.$image->extension();
            $destinationPath = storage_path('app/public/seo');

            File::isDirectory($destinationPath) or File::makeDirectory($destinationPath, 0777, true, true);

            $img = Image::make($image->path());
            $img->save($destinationPath.'/'.$input['twitter_image'], 90);

            $seo->twitter_image = $input['twitter_image'];
        }

        $seo->meta_title = $request->input('meta_title');
        $seo->meta_description = $request->input('meta_description');
        $seo->meta_keywords = $request->input('meta_keywords');
        $seo->og_description = $request->input('og_description');
        $seo->twitter_title = $request->input('twitter_title');
        $seo->twitter_site = $request->input('twitter_site');
        $seo->twitter_creator = $request->input('twitter_creator');
        $seo->twitter_description = $request->input('twitter_description');

        if ($seo->save()) {
            return redirect()->route('admin.seo.edit', $id);
        }

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
