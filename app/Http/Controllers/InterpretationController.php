<?php

namespace App\Http\Controllers;

use App\InterMethod;
use App\InterType;
use App\Languages;
use App\Page;
use Illuminate\Http\Request;

class InterpretationController extends Controller
{
    public function index()
    {
        $page = Page::where('page_number', '=', Page::Interpretation)->first();
        $languages = Languages::all();
        $interpretationMethod = InterMethod::all();
        $interpretationType = InterType::all();

        return view('interpretation.index', compact('page', 'languages', 'interpretationMethod', 'interpretationType'));
    }
}
