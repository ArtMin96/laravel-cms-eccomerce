<?php

namespace App\Http\Controllers;

use App\Catalog;
use App\DocumentLanguages;
use App\Filters\ProductFilters;
use App\Page;
use App\Product;
use Illuminate\Http\Request;

class DocumentShopController extends Controller
{
    public function index() {
        $page = Page::where('page_number', '=', Page::DocumentShop)->first();

        if (request()->catalog) {
            $products = Product::where('sale_type_id', Product::DocumentShop)->whereHas('catalog', function ($query) {
                $query->where('id', request()->catalog);
            })->paginate(2);
        } else {
            $products = Product::where('sale_type_id', Product::DocumentShop)->paginate(2);
        }

        $catalog = Catalog::all();
        $languages = DocumentLanguages::all();
        return view('document-shop.index', compact('page', 'products', 'catalog', 'languages'));
    }

    public function getFilter(ProductFilters $filters)
    {
        $page = Page::where('page_number', '=', Page::DocumentShop)->first();
        $products = Product::filter($filters)->paginate(2);

        $catalog = Catalog::all();
        $languages = DocumentLanguages::all();
        return view('document-shop.index', compact('page', 'products', 'catalog', 'languages'));
    }
}
