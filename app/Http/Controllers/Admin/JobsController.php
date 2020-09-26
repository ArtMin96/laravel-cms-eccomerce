<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\JobRequest;
use App\Jobs;
use Illuminate\Http\Request;

class JobsController extends AdminController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $jobs = Jobs::all();
        return view('admin.jobs.index', compact('jobs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.jobs.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $jobTranslationData = [
            'en' => [
                'title' => $request->input('en_title'),
            ],
            'ru' => [
                'title' => $request->input('ru_title'),
            ],
            'hy' => [
                'title' => $request->input('hy_title'),
            ],
        ];

        $jobs = Jobs::create($jobTranslationData);

        return redirect()->route('admin.jobs.edit', $jobs->id);
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
        $jobs = Jobs::find($id);
        return view('admin.jobs.edit', compact('jobs'));
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
        $jobTranslationData = [
            'en' => [
                'title' => $request->input('en_title'),
            ],
            'ru' => [
                'title' => $request->input('ru_title'),
            ],
            'hy' => [
                'title' => $request->input('hy_title'),
            ],
        ];

        $jobs = Jobs::findOrFail($id);
        $jobs->update($jobTranslationData);

        return redirect()->route('admin.jobs.edit', $id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $jobs = Jobs::findOrFail($request->id);
        $jobs->delete();

        return response()->json(['status' => true]);
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function requests()
    {
        $jobRequests = JobRequest::where('deleted_at', '=', null)->get();
        return view('admin.jobs.requests', compact('jobRequests'));
    }
}
