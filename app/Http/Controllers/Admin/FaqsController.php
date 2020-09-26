<?php

namespace App\Http\Controllers\Admin;

use App\Faqs;
use App\Http\Controllers\Controller;
use Astrotomic\Translatable\Validation\RuleFactory;
use Illuminate\Http\Request;

class FaqsController extends AdminController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $faqs = Faqs::all();
        return view('admin.faqs.index', compact('faqs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.faqs.create');
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
            '%question%' => 'required|string',
            '%answer%' => 'required|string',
        ]);
        $request->validate($rules);

        $faqs = Faqs::create($request->all());

        return redirect()->route('admin.faqs.edit', $faqs->id);
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
        $faqs = Faqs::find($id);
        return view('admin.faqs.edit', compact('faqs'));
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
            '%question%' => 'required|string',
            '%answer%' => 'required|string',
        ]);
        $request->validate($rules);

        $faqs = Faqs::findOrFail($id);
        $faqs->update($request->all());

        return redirect()->route('admin.faqs.edit', $id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $faqs = Faqs::findOrFail($request->id);
        $faqs->delete();

        return response()->json(['status' => true]);
    }
}
