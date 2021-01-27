<?php

namespace App\Http\Controllers\Admin;

use App\Blog;
use Astrotomic\Translatable\Validation\RuleFactory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;

class BlogController extends AdminController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function index()
    {
        $blogs = Blog::all();
        return view('admin.blog.index', compact('blogs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function create()
    {
        return view('admin.blog.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $rules = RuleFactory::make([
            '%title%' => 'required|string',
            '%short_description%' => 'required|string',
            '%description%' => 'required|string',
        ]);
        $request->validate($rules);
        $inputs = $request->all();

        if (isset($inputs['is_img_card'])) {
            $inputs['is_img_card'] = 1;
        } else {
            $inputs['is_img_card'] = 0;
        }

        if ($request->hasFile('image')) {

            $request->validate([
                'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:3000'
            ]);

            $image = $request->file('image');
            $input['imagename'] = time().'.'.$image->extension();
            $destinationPath = storage_path('app/public/blog');

            File::isDirectory($destinationPath) or File::makeDirectory($destinationPath, 0777, true, true);

            $img = Image::make($image->path());
            $img->save($destinationPath.'/'.$input['imagename'], 90);

            $inputs['image'] = $input['imagename'];
        }

        Blog::create($inputs);

        return redirect()->route('admin.blog.index');
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
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function edit($id)
    {
        $blog = Blog::find($id);

        return view('admin.blog.edit', compact('blog'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, int $id): \Illuminate\Http\RedirectResponse
    {
        $blog = Blog::find($id);

        $rules = RuleFactory::make([
            '%title%' => 'required|string',
            '%short_description%' => 'required|string',
            '%description%' => 'required|string',
        ]);
        $request->validate($rules);
        $inputs = $request->all();

        if (isset($inputs['is_img_card'])) {
            $inputs['is_img_card'] = 1;
        } else {
            $inputs['is_img_card'] = 0;
        }

        if ($request->hasFile('image')) {
            $request->validate([
                'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:3000'
            ]);

            $image = $request->file('image');
            $input['imagename'] = time().'.'.$image->extension();
            $destinationPath = storage_path('app/public/blog');

            File::isDirectory($destinationPath) or File::makeDirectory($destinationPath, 0777, true, true);

            $img = Image::make($image->path());
            $img->save($destinationPath.'/'.$input['imagename'], 90);

            $inputs['image'] = $input['imagename'];
        }

        $blog->update($inputs);

        return redirect()->route('admin.blog.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Request $request): \Illuminate\Http\JsonResponse
    {
        $blog = Blog::findOrFail($request->id);
        $blog->delete();

        if (File::exists(storage_path('app/public/blog/' . $blog->image))) {
            File::delete(storage_path('app/public/blog/' . $blog->image));
        }

        return response()->json(['status' => true]);
    }
}
