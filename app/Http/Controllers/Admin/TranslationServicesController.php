<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\TranslationServices;
use Astrotomic\Translatable\Validation\RuleFactory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;

class TranslationServicesController extends AdminController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $translationServices = TranslationServices::withTrashed()->get();
        return view('admin.translation-services.index', compact('translationServices'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.translation-services.create');
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
            '%title%' => 'required|string',
            '%description%' => 'string',
            'icon' => 'image|mimes:jpeg,png,jpg,gif|max:5000',
        ]);
        $request->validate($rules);
        $inputs = $request->all();

        if ($request->hasFile('icon')) {

            $image = $request->file('icon');
            $input['imagename'] = time().'.'.$image->extension();
            $destinationPath = storage_path('app/public/translation-services');

            File::isDirectory($destinationPath) or File::makeDirectory($destinationPath, 0777, true, true);

            $img = Image::make($image->path());
            $img->save($destinationPath.'/'.$input['imagename'], 90);

            $inputs['icon'] = $input['imagename'];
        }

        $translationServices = TranslationServices::create($inputs);

        return redirect()->route('admin.translation-services.index');
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
        $translationServices = TranslationServices::find($id);
        return view('admin.translation-services.edit', compact('translationServices'));
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
            'icon' => 'image|mimes:jpeg,png,jpg,gif|max:5000',
        ]);
        $request->validate($rules);
        $inputs = $request->all();

        if ($request->hasFile('icon')) {
            $image = $request->file('icon');
            $input['imagename'] = time().'.'.$image->extension();
            $destinationPath = storage_path('app/public/translation-services');

            File::isDirectory($destinationPath) or File::makeDirectory($destinationPath, 0777, true, true);

            $img = Image::make($image->path());
            $img->save($destinationPath.'/'.$input['imagename'], 90);

            $inputs['icon'] = $input['imagename'];
        }

        $translationServices = TranslationServices::findOrFail($id);
        $translationServices->update($inputs);

        return redirect()->route('admin.translation-services.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $translationServices = TranslationServices::findOrFail($request->id);
        $translationServices->delete();

        return response()->json(['status' => true]);
    }

    /**
     * Rollback the specified resource from storage.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function rollback(Request $request)
    {
        $translationServices = TranslationServices::withTrashed()->findOrFail($request->id);
        $translationServices->restore();

        return response()->json(['status' => true]);
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function duplicate($id)
    {
        $findService = TranslationServices::findOrFail($id);
        $translationServices = $findService->replicate();
        $translationServices->icon = null;
        $translationServices->save();

        foreach (['en', 'ru', 'hy'] as $locale) {
            $translationServices->translateOrNew($locale)->title = $findService->title;
            $translationServices->translateOrNew($locale)->description = $findService->description;
        }
        $translationServices->save();

        return redirect(route('admin.translation-services.edit', $translationServices->id))->with(['translationServices' => $translationServices]);
    }
}
