<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\OurTeam;
use Astrotomic\Translatable\Validation\RuleFactory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;

class OurTeamController extends AdminController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ourTeam = OurTeam::active();
        return view('admin.our-team.index', compact('ourTeam'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.our-team.create');
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
            '%last_name%' => 'required|string',
            '%position%' => 'required|string',
            '%description%' => 'required|string',
            'image' => 'file|max:5000|mimes:png,jpg,jpeg,gif',
        ]);
        $request->validate($rules);

        $inputs = $request->all();

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $input['imagename'] = time().'.'.$image->extension();
            $destinationPath = storage_path('app/public/member');

            File::isDirectory($destinationPath) or File::makeDirectory($destinationPath, 0777, true, true);

            $img = Image::make($image->path());
            $img->save($destinationPath.'/'.$input['imagename'], 90);

            $inputs['image'] = $input['imagename'];
        }

        $ourTeam = OurTeam::create($inputs);

        return redirect()->route('admin.our-team.edit', $ourTeam->id);
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
        $ourTeam = OurTeam::find($id);
        return view('admin.our-team.edit', compact('ourTeam'));
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
            '%last_name%' => 'required|string',
            '%position%' => 'required|string',
            '%description%' => 'required|string',
            'image' => 'file|max:5000|mimes:png,jpg,jpeg,gif',
        ]);
        $request->validate($rules);

        $inputs = $request->all();

        if ($request->hasFile('image')) {

            $image = $request->file('image');
            $input['imagename'] = time().'.'.$image->extension();
            $destinationPath = storage_path('app/public/member');

            File::isDirectory($destinationPath) or File::makeDirectory($destinationPath, 0777, true, true);

            $img = Image::make($image->path());
            $img->save($destinationPath.'/'.$input['imagename'], 90);

            $inputs['image'] = $input['imagename'];
        }

        $ourTeam = OurTeam::findOrFail($id);
        $ourTeam->update($inputs);

        return redirect()->route('admin.our-team.edit', $id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $teamMember = OurTeam::findOrFail($request->id);
        $teamMember->delete();

        return response()->json(['status' => true]);
    }
}
