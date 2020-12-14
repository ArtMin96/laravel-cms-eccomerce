<?php

namespace App\Http\Controllers;

use App\Page;
use Illuminate\Http\Request;

class TranslateNowController extends Controller
{

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $page = Page::where('page_number', '=', Page::TranslateNow)->first();
        return view('translate-now.index', compact('page'));
    }
}
