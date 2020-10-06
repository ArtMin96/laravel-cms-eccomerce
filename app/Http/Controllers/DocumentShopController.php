<?php

namespace App\Http\Controllers;

use App\Catalog;
use App\Page;
use App\Product;
use Illuminate\Http\Request;

class DocumentShopController extends Controller
{
    public function index() {
        $page = Page::where('page_number', '=', Page::DocumentShop)->first();
        $products = Product::where('sale_type_id', Product::DocumentShop)->paginate(20);
        $catalog = Catalog::all();
        return view('document-shop.index', [
            'page' => $page,
            'products' => $products,
            'catalog' => $catalog,
        ]);
    }
}
