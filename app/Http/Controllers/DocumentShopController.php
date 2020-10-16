<?php

namespace App\Http\Controllers;

use App\Catalog;
use App\DocumentLanguages;
use App\Filters\ProductFilters;
use App\Page;
use App\Product;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class DocumentShopController extends Controller
{
    public function index() {
        $page = Page::where('page_number', '=', Page::DocumentShop)->first();

        if (request()->catalog) {
            $products = Product::where('sale_type_id', Product::DocumentShop)->whereHas('catalog', function ($query) {
                $query->where('id', request()->catalog);
            })->orderBy('id', 'DESC')->paginate(2);
        } else {
            $products = Product::where('sale_type_id', Product::DocumentShop)->orderBy('id', 'DESC')->paginate(6);
        }

        $catalog = Catalog::all();
        $languages = DocumentLanguages::all();
        return view('document-shop.index', compact('page', 'products', 'catalog', 'languages'));
    }

    public function getFilter(ProductFilters $filters)
    {
        $page = Page::where('page_number', '=', Page::DocumentShop)->first();
        $products = Product::filter($filters)->orderBy('id', 'DESC')->paginate(6);

        $catalog = Catalog::all();
        $languages = DocumentLanguages::all();
        $selectedCatalog = \request()->catalog;
        return view('document-shop.index', compact('page', 'products', 'catalog', 'languages', 'selectedCatalog'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\View
     */
    public function getSearch(Request $request)
    {
        $searchTerm = $request->get('q');

        $products = Product::whereLike(['productTranslations.title'], $searchTerm)->where('sale_type_id', Product::DocumentShop)->orderBy('id', 'DESC')->paginate(5);
        $page = Page::where('page_number', '=', Page::DocumentShop)->first();
        $catalog = Catalog::all();
        $languages = DocumentLanguages::all();

        //return display search result to user by using a view
        return view('document-shop.index', compact('products', 'page', 'searchTerm', 'catalog', 'languages'));
    }
}
