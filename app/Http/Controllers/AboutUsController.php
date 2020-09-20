<?php

namespace App\Http\Controllers;

use App\OurTeam;
use App\Page;
use Illuminate\Http\Request;

class AboutUsController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $page = Page::where('page_number', '=', Page::AboutUs)->first();
        $ourTeam = OurTeam::where('deleted_at', '=', null)->get();
        return view('about-us.index', compact('page', 'ourTeam'));
    }
}
