<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyShopScheduleRequest;
use App\Http\Requests\StoreShopScheduleRequest;
use App\Http\Requests\UpdateShopScheduleRequest;
use App\Models\Service;
use App\Models\ServiceEmployee;
use App\Models\ShopSchedule;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ShopScheduleController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('shop_schedule_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $shopSchedules = ShopSchedule::with(['service_employee', 'service'])->get();

        return view('admin.shopSchedules.index', compact('shopSchedules'));
    }

    public function create()
    {
        abort_if(Gate::denies('shop_schedule_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $service_employees = ServiceEmployee::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $services = Service::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.shopSchedules.create', compact('service_employees', 'services'));
    }

    public function store(StoreShopScheduleRequest $request)
    {
        $shopSchedule = ShopSchedule::create($request->all());

        return redirect()->route('admin.shop-schedules.index');
    }

    public function edit(ShopSchedule $shopSchedule)
    {
        abort_if(Gate::denies('shop_schedule_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $service_employees = ServiceEmployee::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $services = Service::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $shopSchedule->load('service_employee', 'service');

        return view('admin.shopSchedules.edit', compact('service_employees', 'services', 'shopSchedule'));
    }

    public function update(UpdateShopScheduleRequest $request, ShopSchedule $shopSchedule)
    {
        $shopSchedule->update($request->all());

        return redirect()->route('admin.shop-schedules.index');
    }

    public function show(ShopSchedule $shopSchedule)
    {
        abort_if(Gate::denies('shop_schedule_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $shopSchedule->load('service_employee', 'service');

        return view('admin.shopSchedules.show', compact('shopSchedule'));
    }

    public function destroy(ShopSchedule $shopSchedule)
    {
        abort_if(Gate::denies('shop_schedule_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $shopSchedule->delete();

        return back();
    }

    public function massDestroy(MassDestroyShopScheduleRequest $request)
    {
        $shopSchedules = ShopSchedule::find(request('ids'));

        foreach ($shopSchedules as $shopSchedule) {
            $shopSchedule->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
