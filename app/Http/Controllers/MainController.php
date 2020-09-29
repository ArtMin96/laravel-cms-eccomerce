<?php

namespace App\Http\Controllers;

use App\Page;
use Illuminate\Http\Request;

class MainController extends FrontController
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $page = Page::where('page_number', '=', Page::Home)->first();
        return view('main.index', compact('page'));
    }
}
