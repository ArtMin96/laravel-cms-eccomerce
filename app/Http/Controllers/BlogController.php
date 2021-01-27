<?php

namespace App\Http\Controllers;

use App\Blog;
use App\Page;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function index()
    {
        $page = Page::where('page_number', '=', Page::Blog)->first();
        $blogs = Blog::paginate(8);
        return view('blog.index', compact('blogs', 'page'));
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($id)
    {
        $blog = Blog::find($id);

        return view('blog.show', compact('blog'));
    }
}
