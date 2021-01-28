<?php

namespace App\Http\Controllers;

use App\InterMethod;
use App\InterType;
use App\Languages;
use App\Page;
use Illuminate\Http\Request;

class ExpertsController extends Controller
{
    public function index()
    {
        $page = Page::where('page_number', '=', Page::Experts)->first();
        $languages = Languages::all();
        $interpretationMethod = InterMethod::all();
        $interpretationType = InterType::all();

        return view('experts.index', compact('page', 'languages', 'interpretationMethod', 'interpretationType'));
    }
}
