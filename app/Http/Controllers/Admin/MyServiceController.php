<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\Service;
use App\Models\ServiceDuration;
use App\Models\ShopCompany;
use App\Models\ShopProductCategory;
use App\Models\ShopProductSubCategory;
use App\Models\ShopTax;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class MyServiceController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('my_service_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $services = Service::with(['shop_company', 'service_duration', 'shop_product_categories', 'shop_product_sub_categories', 'tax', 'media'])->get();

        return view('admin.myServices.index', compact('services'));
    }

    public function create()
    {
        abort_if(Gate::denies('my_service_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $company = User::where('id', auth()->user()->id)
            ->with('company.shop_company')
            ->first()->company[0];

        $service_durations = ServiceDuration::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $shop_product_categories = ShopProductCategory::where('company_id', $company->id)->pluck('name', 'id');

        $shop_product_sub_categories = ShopProductSubCategory::whereHas('shop_product_category', function ($query) use ($company) {
            $query->where('company_id', $company->id);
        })->pluck('name', 'id');

        $position = Service::where('shop_company_id', $company->shop_company->id)->count() + 1;

        $taxes = ShopTax::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.myServices.create', compact('service_durations', 'company', 'shop_product_categories', 'shop_product_sub_categories', 'taxes', 'position'));

    }

    public function edit(Request $request)
    {

        abort_if(Gate::denies('my_service_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.myServices.edit');
    }

}