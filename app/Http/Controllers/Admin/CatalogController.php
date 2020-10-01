<?php

namespace App\Http\Controllers\Admin;

use App\Catalog;
use App\Http\Controllers\Controller;
use Astrotomic\Translatable\Validation\RuleFactory;
use Illuminate\Http\Request;

class CatalogController extends AdminController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $catalogs = Catalog::withTrashed()->get();
        return view('admin.catalog.index', compact('catalogs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.catalog.create');
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
        ]);
        $request->validate($rules);

        Catalog::create($request->all());

        return redirect()->route('admin.catalog.index');
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
        $catalog = Catalog::find($id);
        return view('admin.catalog.edit', compact('catalog'));
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
        ]);
        $request->validate($rules);

        $catalog = Catalog::findOrFail($id);
        $catalog->update($request->all());

        return redirect()->route('admin.catalog.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Request $request)
    {
        $catalog = Catalog::findOrFail($request->id);
        $catalog->delete();

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
        $catalog = Catalog::withTrashed()->findOrFail($request->id);
        $catalog->restore();

        return response()->json(['status' => true]);
    }
}
