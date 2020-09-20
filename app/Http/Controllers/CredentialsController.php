<?php

namespace App\Http\Controllers;

use App\Credentials;
use App\Page;
use Illuminate\Http\Request;

class CredentialsController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $page = Page::where('page_number', '=', Page::Credentials)->first();
        $credentials = Credentials::where('deleted_at', '=', null)->get();
        return view('credentials.index', compact('page', 'credentials'));
    }
}
