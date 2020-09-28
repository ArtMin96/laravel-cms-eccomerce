<?php

namespace App\Http\Controllers;

use App\Page;
use App\Settings;
use Illuminate\Http\Request;

class GetInTouchController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $page = Page::where('page_number', '=', Page::GetInTouch)->first();
        $contacts = Settings::first();
        return view('get-in-touch.index', compact('page', 'contacts'));
    }
}
