<?php

namespace App\Http\Controllers\Admin;

use App\Catalog;
use App\DocumentLanguages;
use App\Http\Controllers\Controller;
use App\Product;
use App\ProductFiles;
use App\SaleType;
use Astrotomic\Translatable\Validation\RuleFactory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class ProductController extends AdminController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $products = Product::withTrashed()->where('sale_type_id', $id)->get();
        $saleType = SaleType::where('id', $id)->first();
        return view('admin.product.index', compact('products', 'saleType'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $saleType = SaleType::where('id', $id)->first();
        $catalog = Catalog::all();
        $languages = DocumentLanguages::all();
        return view('admin.product.create', compact('id', 'saleType', 'catalog', 'languages'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = RuleFactory::make([
            '%title%' => 'required|string',
            '%description%' => 'nullable|string',
            'price' => 'required|numeric',
        ]);

        if ($request->input('sale_type_id') == 3) {
            $rules = RuleFactory::make([
                '%title%' => 'required|string',
                '%description%' => 'nullable|string',
                'price' => 'nullable|numeric',
                'file.*' => 'required|image|mimes:jpeg,png,jpg,gif|max:5000',
            ]);
        }

        if ($request->input('sale_type_id') == 1) {
            $rules = RuleFactory::make([
                '%title%' => 'required|string',
                '%description%' => 'nullable|string',
                'price' => 'required|numeric',
                'file.*' => 'required|mimes:pdf|max:25000',
            ]);
        }

        $request->validate($rules);

        $product = new Product();
        $product->user_id = \Auth::check() ? \Auth::user()->id : null;
        $product->sale_type_id = $request->input('sale_type_id');
        $product->price = $request->input('price');
        $product->language = $request->input('language');
        $product->save();

        $product->catalog()->attach($request->input('catalog'));

        $translationProduct = Product::withTrashed()->findOrFail($product->id);
        $translationProduct->update([
            'en' => [
                'title' => $request->input('en')['title'],
                'description' => !empty($request->input('en')['description'])? $request->input('en')['description'] : null
            ],
            'ru' => [
                'title' => $request->input('ru')['title'],
                'description' => !empty($request->input('ru')['description'])? $request->input('ru')['description'] : null
            ],
            'hy' => [
                'title' => $request->input('hy')['title'],
                'description' => !empty($request->input('hy')['description'])? $request->input('hy')['description'] : null
            ]
        ]);

        if ($request->hasFile('file')) {

            $fileModel = new ProductFiles();
            $fileName = time().'_'.str_replace(' ', '_', $request->file->getClientOriginalName());
            $filePath = $request->file('file')->storeAs('products', $fileName, 'public');

            $fileModel->product_id = $product->id;
            $fileModel->file = $fileName;
            $fileModel->url = '/storage/' . $filePath;
            $fileModel->save();
        }

        return redirect()
            ->route('admin.product.index', $request->input('sale_type_id'))
            ->with('message', __('messages.product_created_success'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Product::find($id);
        $saleType = SaleType::where('id', $id)->first();
        $catalog = Catalog::all();
        $languages = DocumentLanguages::all();
        return view('admin.product.edit', compact('product', 'saleType', 'catalog', 'languages'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $rules = RuleFactory::make([
            '%title%' => 'required|string',
            '%description%' => 'nullable|string',
            'price' => 'required|numeric',
        ]);

        if ($request->input('sale_type_id') == 3) {
            $rules = RuleFactory::make([
                '%title%' => 'required|string',
                '%description%' => 'nullable|string',
                'price' => 'nullable|numeric',
                'file.*' => 'required|image|mimes:jpeg,png,jpg,gif|max:5000',
            ]);
        }

        if ($request->input('sale_type_id') == 1) {
            $rules = RuleFactory::make([
                '%title%' => 'required|string',
                '%description%' => 'nullable|string',
                'price' => 'required|numeric',
                'file.*' => 'required|mimes:pdf|max:25000',
            ]);
        }

        $request->validate($rules);

        $product = Product::findOrFail($id);
        $product->user_id = \Auth::check() ? \Auth::user()->id : null;
        $product->sale_type_id = $request->input('sale_type_id');
        $product->price = $request->input('price');
        $product->language = $request->input('language');
        $product->save();

        $product->catalog()->sync($request->input('catalog'));

        $translationProduct = Product::withTrashed()->findOrFail($product->id);
        $translationProduct->update([
            'en' => [
                'title' => $request->input('en')['title'],
                'description' => $request->input('en')['description']
            ],
            'ru' => [
                'title' => $request->input('ru')['title'],
                'description' => $request->input('ru')['description']
            ],
            'hy' => [
                'title' => $request->input('hy')['title'],
                'description' => $request->input('hy')['description']
            ]
        ]);

        if ($request->hasFile('file')) {

            $fileModel = new ProductFiles();
            $fileName = time().'_'.str_replace(' ', '_', $request->file->getClientOriginalName());
            $filePath = $request->file('file')->storeAs('products', $fileName, 'public');

            $fileModel->product_id = $product->id;
            $fileModel->file = $fileName;
            $fileModel->url = '/storage/' . $filePath;
            $fileModel->save();
        }

        return redirect()
            ->route('admin.product.index', $request->input('sale_type_id'))
            ->with('message', __('messages.product_created_success'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Request $request)
    {
        $product = Product::with('productFiles')->where('id', $request->id)->first();
        $product->productFiles()->delete();

        if ($product->delete()) {
            return response()->json(['status' => true]);
        } else {
            return response()->json(['status' => false]);
        }
    }

    /**
     * Rollback the specified resource from storage.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function rollback(Request $request)
    {
        $product = Product::withTrashed()->findOrFail($request->id);
        $product->restore();

        $product->productFiles()->restore();

        return response()->json(['status' => true]);
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function duplicate($id)
    {
        $findProduct = Product::findOrFail($id);
        $product = $findProduct->replicate();
        $product->save();

        foreach (['en', 'ru', 'hy'] as $locale) {
            $product->translateOrNew($locale)->title = $findProduct->title;
        }
        $product->save();

        return redirect(route('admin.product.edit', $product->id))->with(['product' => $product]);
    }
}
