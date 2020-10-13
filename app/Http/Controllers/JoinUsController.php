<?php

namespace App\Http\Controllers;

use App\JobRequest;
use App\Jobs;
use App\Page;
use Illuminate\Http\Request;

class JoinUsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $page = Page::where('page_number', '=', Page::JoinUs)->first();
        $jobs = Jobs::where('deleted_at', '=', null)->get();
        return view('join-us.index', compact('page', 'jobs'));
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
        $request->validate([
            'name' => 'required|string',
            'last_name' => 'required|string',
            'phone' => 'required|phone:AM', // Change AM to $this->getGeocodeCountryCode()
            'email' => 'required|email',
            'field_expertise' => 'required',
            'year_expertise' => 'required',
            'translated_page_number' => 'numeric',
            'daily_translation_capacity' => 'numeric',
            'translation_rate_per_page' => 'required_if:translator_type, 0',
            'monthly_salary_expectation' => 'required_if:translator_type, 1',
            'cv' => 'required|file|max:5000|mimes:doc,pdf,docx',
        ]);

        $input = $request->all();

        if ($file = $request->file('cv')) {
            $destinationPath = storage_path('app/public/jobs');
            $fileName = time().'.'.$file->getClientOriginalExtension();
            $file->move($destinationPath, $fileName);
            $input['cv'] = $fileName;
        }

        JobRequest::create($input);

        return redirect()->back()->with('message', __('Your job application has been successfully submitted'));
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
        //
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
        //
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
