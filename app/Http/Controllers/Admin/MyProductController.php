<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ShopProduct;
use App\Models\ShopProductCategory;
use App\Models\ShopProductFeature;
use App\Models\ShopProductSubCategory;
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

        $shop_product_sub_categories = ShopProductSubCategory::with('shop_product_category.company')->whereHas('shop_product_category', function ($query) use ($company) {
            $query->whereHas('company', function ($q) use ($company) {
                $q->where('id', $company->id);
            });
        })->get()->pluck('name', 'id');

        return view('admin.myProducts.create', compact('shop_product_categories', 'shop_product_sub_categories', 'taxes'));
    }

    public function edit(Request $request)
    {
        abort_if(Gate::denies('my_product_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $shop_product_categories = ShopProductCategory::pluck('name', 'id');

        $shop_product_sub_categories = ShopProductSubCategory::pluck('name', 'id');

        $taxes = ShopTax::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $shopProduct = ShopProduct::where('id', $request->id)
            ->first();

        return view('admin.myProducts.edit', compact('shopProduct', 'shop_product_categories', 'shop_product_sub_categories', 'taxes'));
    }

    public function newShopProductFeature(Request $request)
    {
        $shopProductFeature = new ShopProductFeature;
        $shopProductFeature->shop_product_id = $request->shop_product_id;
        $shopProductFeature->name = $request->name;
        $shopProductFeature->save();
    }

    public function shopProductFeatureList(Request $request)
    {
        $shopProductFeatures = ShopProductFeature::where('shop_product_id', $request->shop_product_id)->get();

        return view('admin.myProducts.featureList', compact('shopProductFeatures'));
    }

    public function deleteShopProductFeature(Request $request)
    {
        ShopProductFeature::where('id', $request->shop_product_feature_id)->first()->delete();
    }

}