<?php

namespace App\Http\Controllers;

use App\Customers;
use App\Page;
use Illuminate\Http\Request;

class CustomersController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $page = Page::where('page_number', '=', Page::Credentials)->first();
        $customers = Customers::where('deleted_at', '=', null)->get();
        return view('customers.index', compact('page', 'customers'));
    }
}
