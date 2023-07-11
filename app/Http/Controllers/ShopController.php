<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\Country;
use App\Models\Page;
use App\Models\ShopCategory;
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

        $shop_categories = ShopCategory::orderBy('name')->get();

        $shop_categories_slide = ShopCategory::inRandomOrder()->get()->chunk(4);
        $shop_products = ShopProduct::inRandomOrder()->limit(21)->get()->chunk(3);
        $companies = Company::inRandomOrder()->limit(20)->get()->chunk(4);

        return view('website.shop.index', compact('shop_categories', 'shop_categories_slide', 'shop_products', 'companies'));
    }

    public function product(Request $request)
    {
        $product = ShopProduct::find($request->id)->load('shop_product_features', 'shop_product_variations', 'shop_product_categories.company.shop_company');

        return view('website.shop.product', compact('product'));
    }

    public function checkout()
    {

        $countries = Country::all();
        $user = auth()->user();
        $address = null;

        if ($user) {
            $address = $user->address;
        }

        return view('website.shop.checkout', compact('countries', 'user', 'address'));
    }

    public function innerCheckout()
    {

        $products = collect(session()->get('cart'));

        $user = auth()->user();

        $address = null;

        if ($user) {
            $address = $user->address;
        }

        $total_array = [];

        foreach ($products as $product) {
            $total_array[] = $product['quantity'] * $product['product']['price'];
        }

        $total = number_format(array_sum($total_array), 2);

        return view('website.components.inner_checkout', compact('products', 'total', 'user', 'address'));
    }

    public function category($category_id)
    {
        $shop_categories = ShopCategory::orderBy('name')->get();
        $category = ShopCategory::find($category_id);

        $companies = Company::whereHas('shop_company', function ($query) use ($category) {
            $query->whereHas('shop_categories', function ($q) use ($category) {
                $q->where('id', $category->id);
            });
        })->get();

        $products = ShopProduct::whereHas('shop_product_categories', function ($query) use ($category) {
            $query->where('id', $category->id);
        })->limit(20)->get();

        return view('website.shop.category', compact('shop_categories', 'category', 'companies', 'products'));
    }

    public function company($company_id)
    {
        $shop_categories = ShopCategory::orderBy('name')->get();
        $company = Company::find($company_id)->load('shop_company.shop_company_schedules');
        $products = ShopProduct::whereHas('shop_product_categories', function ($query) use ($company) {
            $query->where('company_id', $company->id);
        })->get()->load('shop_product_categories');        

        return view('website.shop.company', compact('shop_categories', 'products', 'company'));
    }

}