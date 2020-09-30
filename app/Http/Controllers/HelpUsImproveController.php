<?php

namespace App\Http\Controllers;

use App\ImproveRating;
use App\Page;
use App\RateService;
use App\Rating;
use Illuminate\Http\Request;

class HelpUsImproveController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $page = Page::where('page_number', '=', Page::HelpUsImprove)->first();
        $rateService = RateService::all();
        return view('help-us-improve.index', compact('page', 'rateService'));
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
            'email' => 'required|email',
            'star' => 'required',
        ]);

        if (!empty($request->input('star'))) {
            $improveRating = new ImproveRating();
            $improveRating->user_id = \Auth::user()->id;
            $improveRating->name = $request->input('name');
            $improveRating->email = $request->input('email');
            $improveRating->comment = $request->input('comment');
            $improveRating->allow_share = $request->input('allow_share');

            if ($improveRating->save()) {
                foreach ($request->input('star') as $key => $star) {
                    $rating = new Rating();
                    $rating->rating_id = $improveRating->id;
                    $rating->service_id = $request->input('service')[$key];
                    $rating->star = $request->input('star')[$key];
                    $rating->save();
                }
            }
        }

        return back()->with('message', __('messages.feedback_success'));
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
