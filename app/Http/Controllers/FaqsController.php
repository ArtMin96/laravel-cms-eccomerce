<?php

namespace App\Http\Controllers;

use App\Faqs;
use App\Page;
use Illuminate\Http\Request;

class FaqsController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $page = Page::where('page_number', '=', Page::FAQs)->first();
        $faqs = Faqs::where('deleted_at', '=', null)->paginate(3);
        return view('faqs.index', compact('page', 'faqs'));
    }
}
