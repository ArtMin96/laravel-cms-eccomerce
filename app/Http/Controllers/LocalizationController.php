<?php

namespace App\Http\Controllers;

use App\Languages;
use App\Page;
use Illuminate\Http\Request;

class LocalizationController extends Controller
{
    public function index()
    {
        $page = Page::where('page_number', '=', Page::Localization)->first();
        $languages = Languages::all();

        return view('localization.index', compact('page', 'languages'));
    }
}
