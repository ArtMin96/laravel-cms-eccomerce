<?php

namespace App\Http\Controllers\Admin;

use App\CompanyLogos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;

class CompanyLogosController extends AdminController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $companyLogos = CompanyLogos::all();
        return view('admin.company-logos.index', compact('companyLogos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.company-logos.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'icon' => 'required|image|mimes:jpeg,png,jpg,gif|max:5000',
        ]);
        $inputs = $request->all();

        if ($request->hasFile('icon')) {

            $image = $request->file('icon');
            $input['imagename'] = time().'.'.$image->extension();
            $destinationPath = storage_path('app/public/company-logos');

            File::isDirectory($destinationPath) or File::makeDirectory($destinationPath, 0777, true, true);

            $img = Image::make($image->path());
            $img->save($destinationPath.'/'.$input['imagename'], 90);

            $inputs['icon'] = $input['imagename'];
        }

        $companyLogos = CompanyLogos::create($inputs);

        return redirect()->route('admin.company-logos.index');
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
        $companyLogos = CompanyLogos::find($id);
        return view('admin.company-logos.edit', compact('companyLogos'));
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
        $inputs = $request->all();

        if ($request->hasFile('icon')) {

            $request->validate([
                'icon' => 'required|image|mimes:jpeg,png,jpg,gif|max:5000',
            ]);

            $image = $request->file('icon');
            $input['imagename'] = time().'.'.$image->extension();
            $destinationPath = storage_path('app/public/company-logos');

            File::isDirectory($destinationPath) or File::makeDirectory($destinationPath, 0777, true, true);

            $img = Image::make($image->path());
            $img->save($destinationPath.'/'.$input['imagename'], 90);

            $inputs['icon'] = $input['imagename'];
        }

        $companyLogos = CompanyLogos::findOrFail($id);
        $companyLogos->update($inputs);

        return redirect()->route('admin.company-logos.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Request $request)
    {
        $companyLogos = CompanyLogos::findOrFail($request->id);

        if (!empty($companyLogos->icon)) {
            $file = storage_path('app/public/company-logos/'.$companyLogos->icon);
            if (File::exists($file)) {
                unlink(storage_path('app/public/company-logos/'.$companyLogos->icon));
            }
        }

        $companyLogos->delete();

        return response()->json(['status' => true]);
    }
}
