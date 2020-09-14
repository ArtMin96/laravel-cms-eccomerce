<?php

namespace App\Http\Controllers;

use App\Page;
use Illuminate\Http\Request;

class PagesController extends Controller
{

    /**
     * Load dynamic pages from database with related data.
     *
     * @param string $slug
     * @return \Illuminate\Contracts\View\View
     */
    public function show ($slug = '/') {
        $page = Page::where('alias', $slug)->where('deleted_at', null)->first();

        if (empty($page)) {
            abort('404');
        }

        return \View::make('pages.index')->with('page', $page);
    }


    public function blog () {
        $page = Page::where('page_number', Page::Home)->where('deleted_at', null)->first();

        if (empty($page)) {
            abort('404');
        }

        return \View::make('pages.index')->with('page', $page);
    }
}
