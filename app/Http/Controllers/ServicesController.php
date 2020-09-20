<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Page;
use Illuminate\Http\Request;

class ServicesController extends Controller
{
    /**
     * Load dynamic pages from database with related data.
     *
     * @param string $slug
     * @return \Illuminate\Contracts\View\View
     */
    public function show ($slug = '/') {
        $page = Page::where('alias', $slug)->where('deleted_at', null)->where('route_number', '=', Page::ServiceRoute)->first();

        if (empty($page)) {
            abort('404');
        }

        return \View::make('services.index')->with('page', $page);
    }
}
