<?php

namespace App\Http\Controllers;

use App\Languages;
use App\Page;
use Illuminate\Http\Request;

class TranslationController extends Controller
{
    public function index()
    {
        $page = Page::where('page_number', '=', Page::Translation)->first();
        $languages = Languages::all();
        return view('translation.index', compact('page', 'languages'));
    }
}
