<?php

namespace App\Http\Controllers\Admin;

use App\Credentials;
use Astrotomic\Translatable\Validation\RuleFactory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;

class CredentialsController extends AdminController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $credentials = Credentials::active();
        return view('admin.credentials.index', compact('credentials'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.credentials.create');
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
            '%description%' => 'required|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:5000',
        ]);
        $request->validate($rules);
        $inputs = $request->all();

        if ($request->hasFile('image')) {

            $image = $request->file('image');
            $input['imagename'] = time().'.'.$image->extension();
            $destinationPath = storage_path('app/public/credentials');

            File::isDirectory($destinationPath) or File::makeDirectory($destinationPath, 0777, true, true);

            $img = Image::make($image->path());
            $img->save($destinationPath.'/'.$input['imagename'], 90);

            $inputs['image'] = $input['imagename'];
        }

        $credential = Credentials::create($inputs);

        return redirect()->route('admin.credentials.edit', $credential->id);
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
        $credentials = Credentials::find($id);
        return view('admin.credentials.edit', compact('credentials'));
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
            '%description%' => 'required|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:5000',
        ]);
        $request->validate($rules);
        $inputs = $request->all();

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $input['imagename'] = time().'.'.$image->extension();
            $destinationPath = storage_path('app/public/credentials');

            File::isDirectory($destinationPath) or File::makeDirectory($destinationPath, 0777, true, true);

            $img = Image::make($image->path());
            $img->save($destinationPath.'/'.$input['imagename'], 90);

            $inputs['image'] = $input['imagename'];
        }

        $credential = Credentials::findOrFail($id);
        $credential->update($inputs);

        return redirect()->route('admin.credentials.edit', $id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $credential = Credentials::findOrFail($request->id);
        $credential->delete();

        return response()->json(['status' => true]);
    }
}
