<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use App\Models\ServiceEmployee;
use App\Models\ShopCompany;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class MyEmployeesController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('my_employee_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $shop_company = User::find(auth()->user()->id)->load('company.shop_company')->company[0]->shop_company;

        $serviceEmployees = ServiceEmployee::with(['shop_company', 'services'])
            ->where('shop_company_id', $shop_company->id)
            ->get();

        return view('admin.myEmployees.index', compact('serviceEmployees'));
    }

    public function create()
    {
        abort_if(Gate::denies('my_employee_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $shop_company = User::find(auth()->user()->id)->load('company.shop_company')->company[0]->shop_company;

        $services = Service::where('shop_company_id', $shop_company->id)->pluck('name', 'id');

        return view('admin.myEmployees.create', compact('services', 'shop_company'));

    }

    public function edit(Request $request)
    {

        abort_if(Gate::denies('my_employee_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $shop_company = User::find(auth()->user()->id)->load('company.shop_company')->company[0]->shop_company;

        $services = Service::where('shop_company_id', $shop_company->id)->pluck('name', 'id');

        $serviceEmployee = ServiceEmployee::find($request->id)->load('shop_company', 'services');

        return view('admin.myEmployees.edit', compact('serviceEmployee', 'services', 'shop_company'));

    }

}