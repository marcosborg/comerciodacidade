<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\Country;
use App\Models\Page;
use App\Models\Service;
use App\Models\ShopCategory;
use App\Models\ShopProduct;
use App\Models\ShopProductCategory;
use App\Models\ShopProductSubCategory;
use Illuminate\Http\Request;

class ShopController extends Controller
{

    public function __construct()
    {
        view()->share('pages', Page::all());
        view()->share('shop_categories', ShopCategory::all());
    }

    public function index()
    {

        $shop_categories_slide = ShopCategory::inRandomOrder()->get()->chunk(4);
        $shop_products = ShopProduct::inRandomOrder()->limit(21)->get()->chunk(3);
        $companies = Company::inRandomOrder()->limit(20)->get()->chunk(4);

        return view('website.shop.index', compact('shop_categories_slide', 'shop_products', 'companies'));
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
        $category = ShopCategory::find($category_id);

        $companies = Company::whereHas('shop_company', function ($query) use ($category) {
            $query->whereHas('shop_categories', function ($q) use ($category) {
                $q->where('id', $category->id);
            });
        })->get();

        $products = ShopProduct::whereHas('shop_product_categories', function ($query) use ($category) {
            $query->where('id', $category->id);
        })->limit(20)->get();

        return view('website.shop.category', compact('category', 'companies', 'products'));
    }

    public function company($company_id)
    {
        $shop_categories = ShopCategory::orderBy('name')->get();
        $company = Company::find($company_id)->load('shop_company.shop_company_schedules');

        return view('website.shop.company', compact('shop_categories', 'company'));
    }

    public function products($company_id, $shop_product_category_id)
    {

        $company = Company::find($company_id)->load('shop_company.shop_company_schedules');

        $shop_product_categories = ShopProductCategory::where('company_id', $company->id)->get();

        $products = ShopProduct::whereHas('shop_product_categories', function ($query) use ($company, $shop_product_category_id) {
            $query->where('company_id', $company->id);
            if ($shop_product_category_id != 'todos') {
                $query->where('id', $shop_product_category_id);
            }
        })->get()->load('shop_product_sub_categories');

        $shop_product_sub_categories = ShopProductSubCategory::whereHas('shop_product_category', function ($query) use ($company, $shop_product_category_id) {
            $query->where('company_id', $company->id);
            $query->where('id', $shop_product_category_id);
        })->get();

        return view('website.shop.products', compact('shop_product_categories', 'products', 'company', 'shop_product_sub_categories', 'shop_product_category_id'));
    }

    public function searchInShop(Request $request)
    {
        $companies = Company::where('name', 'LIKE', '%' . $request->search . '%')
            ->limit(10)
            ->inRandomOrder()
            ->get();

        $results = collect();

        foreach ($companies as $company) {
            $results->add([
                'type' => 'company',
                'id' => $company->id,
                'name' => $company->name,
                'more' => $company->location,
                'image' => $company->logo ? $company->logo->thumbnail : null,
            ]);
        }

        $products = ShopProduct::where('name', 'LIKE', '%' . $request->search . '%')
            ->limit(10)
            ->inRandomOrder()
            ->get();

        foreach ($products as $product) {
            $results->add([
                'type' => 'product',
                'id' => $product->id,
                'name' => $product->name,
                'more' => '€' . $product->price,
                'image' => count($product->photos) > 0 ? $product->photos[0]->thumbnail : null,
            ]);
        }

        $services = Service::where('name', 'LIKE', '%' . $request->search . '%')
            ->limit(10)
            ->inRandomOrder()
            ->get();

        foreach ($services as $service) {
            $results->add([
                'type' => 'service',
                'id' => $service->id,
                'name' => $service->name,
                'more' => '€' . $service->price,
                'image' => count($service->photos) > 0 ? $service->photos[0]->thumbnail : null,
            ]);
        }

        $categories = ShopCategory::where('name', 'LIKE', '%' . $request->search . '%')
            ->limit(10)
            ->inRandomOrder()
            ->get();

        foreach ($categories as $category) {
            $results->add([
                'type' => 'category',
                'id' => $category->id,
                'name' => $category->name,
                'more' => $category->description,
                'image' => $category->image ? $category->image->thumbnail : null,
            ]);
        }

        $results = $results->shuffle();

        return view('website.components.search_results', compact('results'));
    }

}