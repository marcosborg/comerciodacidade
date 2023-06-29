<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Page;
use App\Models\ShopProduct;
use Illuminate\Http\Request;

class ShopController extends Controller
{

    public function __construct()
    {
        view()->share('pages', Page::all());
    }

    public function index()
    {
        return view('website.shop.index');
    }

    public function product(Request $request)
    {

        $product = ShopProduct::find($request->id)->load('shop_product_features', 'shop_product_variations', 'shop_product_categories.company.shop_company');

        return view('website.shop.product', compact('product'));
    }

    public function checkout()
    {
        return view('website.shop.checkout');
    }

    public function innerCheckout()
    {

        $products = collect(session()->get('cart'));

        $user = auth()->user();

        $address = null;

        if($user){
            $address = $user->address;
        }

        $total_array = [];

        foreach ($products as $product) {
            $total_array[] = $product['quantity'] * $product['product']['price'];
        }

        $total = number_format(array_sum($total_array), 2);

        return view('website.components.inner_checkout', compact('products', 'total', 'user', 'address'));
    }

}