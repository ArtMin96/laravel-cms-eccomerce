<?php

namespace App\Http\Controllers;

use App\Catalog;
use App\DocumentLanguages;
use App\Page;
use App\Product;
use Illuminate\Http\Request;

class DocumentTemplateController extends Controller
{
    public function index() {
        $page = Page::where('page_number', '=', Page::DocumentTemplates)->first();

        $productQuery = Product::where('sale_type_id', Product::DocumentTemplate);

        if (request()->catalog) {
            $productQuery->whereHas('catalog', function ($query) {
                $query->where('id', request()->catalog);
            });
        }

        if (request()->language) {
            $productQuery->whereHas('documentLanguage', function ($query) {
                $query->where('id', request()->language);
            });
        }

        $products = $productQuery->orderBy('id', 'DESC')->paginate(8);

        $catalog = Catalog::all();
        $languages = DocumentLanguages::all();
        return view('document-template.index', compact('page', 'products', 'catalog', 'languages'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\View
     */
    public function getSearch(Request $request)
    {
        $searchTerm = $request->get('q');

        $productQuery = Product::whereLike(['productTranslations.title'], $searchTerm)->where('sale_type_id', Product::DocumentTemplate);

        if (request()->catalog) {
            $productQuery->whereHas('catalog', function ($query) {
                $query->where('id', request()->catalog);
            });
        }

        if (request()->language) {
            $productQuery->whereHas('documentLanguage', function ($query) {
                $query->where('id', request()->language);
            });
        }

        $products = $productQuery->orderBy('id', 'DESC')->paginate(8);

        $page = Page::where('page_number', '=', Page::DocumentTemplates)->first();
        $catalog = Catalog::all();
        $languages = DocumentLanguages::all();

        //return display search result to user by using a view
        return view('document-template.index', compact('products', 'page', 'searchTerm', 'catalog', 'languages'));
    }
}
