<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use App\Models\ServiceEmployee;
use App\Models\ShopCompany;
use App\Models\ShopSchedule;
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

    public function schedules(Request $request)
    {

        $shop_schedules = ShopSchedule::where([
            'service_employee_id' => $request->id,
        ])
            ->get()->load('service');

        $service_employee = ServiceEmployee::find($request->id);

        $services = Service::where('shop_company_id', $service_employee->shop_company_id)->get();

        return view('admin.myEmployees.schedules', compact('service_employee', 'services', 'shop_schedules'));
    }

    public function getSchedule(Request $request)
    {
        $shop_schedule = ShopSchedule::find($request->id);

        return $shop_schedule;
    }

    public function deleteSchedule(Request $request)
    {
        ShopSchedule::find($request->id)->delete();

        return redirect()->back()->with('message', 'Apagado com sucesso.');
    }

}