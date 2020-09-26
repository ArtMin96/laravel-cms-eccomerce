<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\JobRequest;
use Illuminate\Http\Request;

class JobRequestsController extends AdminController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $jobRequests = JobRequest::where('deleted_at', '=', null)->get();
        return view('admin.job-requests.index', compact('jobRequests'));
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
        $jobRequest = JobRequest::findOrFail($id);
        return view('admin.job-requests.show', compact('jobRequest'));
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
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Request $request)
    {
        $jobRequest = JobRequest::findOrFail($request->id);
        $jobRequest->delete();

        return response()->json(['status' => true]);
    }

    /**
     * @param $file
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function download($file)
    {
        $ext = pathinfo(storage_path('app/public/jobs').'/'.$file, PATHINFO_EXTENSION);
        $headers = array(
            'Content-Type' => 'application/'.$ext,
            'Content-Disposition' => 'attachment; filename=' . $file,
        );

        return response()->file(storage_path('app/public/jobs').'/'.$file, $headers);
    }
}
