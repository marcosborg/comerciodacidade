<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ShopProduct;
use App\Models\ShopProductCategory;
use App\Models\ShopTax;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class MyProductController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('my_product_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $company = User::where('id', auth()->user()->id)->with('company')->first()->company[0];

        $shopProducts = ShopProduct::whereHas('shop_product_categories', function ($query) use ($company) {
            $query->where('company_id', $company->id);
        })->with(['shop_product_categories', 'tax', 'media'])->get();

        return view('admin.myProducts.index', compact('shopProducts'));
    }

    public function create()
    {
        abort_if(Gate::denies('my_product_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $company = User::where('id', auth()->user()->id)->with('company')->first()->company[0];

        $taxes = ShopTax::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $shop_product_categories = ShopProductCategory::whereHas('company', function ($query) use ($company) {
            $query->where('company_id', $company->id);
        })->get()->pluck('name', 'id');

        return view('admin.myProducts.create', compact('shop_product_categories', 'taxes'));
    }

}