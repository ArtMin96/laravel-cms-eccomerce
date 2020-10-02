<?php

namespace App\Http\Controllers;

use App\Page;
use App\Product;
use Illuminate\Http\Request;

class RentEquipmentController extends Controller
{
    public function index() {
        $page = Page::where('page_number', '=', Page::RentEquipment)->first();
        $products = Product::where('sale_type_id', Product::RentEquipment)->paginate(20);
        return view('rent-equipment.index', [
            'page' => $page,
            'products' => $products
        ]);
    }
}
