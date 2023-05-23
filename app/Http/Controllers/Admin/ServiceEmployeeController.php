<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyServiceEmployeeRequest;
use App\Http\Requests\StoreServiceEmployeeRequest;
use App\Http\Requests\UpdateServiceEmployeeRequest;
use App\Models\Service;
use App\Models\ServiceEmployee;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ServiceEmployeeController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('service_employee_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $serviceEmployees = ServiceEmployee::with(['services'])->get();

        return view('admin.serviceEmployees.index', compact('serviceEmployees'));
    }

    public function create()
    {
        abort_if(Gate::denies('service_employee_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $services = Service::pluck('name', 'id');

        return view('admin.serviceEmployees.create', compact('services'));
    }

    public function store(StoreServiceEmployeeRequest $request)
    {
        $serviceEmployee = ServiceEmployee::create($request->all());
        $serviceEmployee->services()->sync($request->input('services', []));

        return redirect()->route('admin.service-employees.index');
    }

    public function edit(ServiceEmployee $serviceEmployee)
    {
        abort_if(Gate::denies('service_employee_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $services = Service::pluck('name', 'id');

        $serviceEmployee->load('services');

        return view('admin.serviceEmployees.edit', compact('serviceEmployee', 'services'));
    }

    public function update(UpdateServiceEmployeeRequest $request, ServiceEmployee $serviceEmployee)
    {
        $serviceEmployee->update($request->all());
        $serviceEmployee->services()->sync($request->input('services', []));

        return redirect()->route('admin.service-employees.index');
    }

    public function show(ServiceEmployee $serviceEmployee)
    {
        abort_if(Gate::denies('service_employee_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $serviceEmployee->load('services');

        return view('admin.serviceEmployees.show', compact('serviceEmployee'));
    }

    public function destroy(ServiceEmployee $serviceEmployee)
    {
        abort_if(Gate::denies('service_employee_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $serviceEmployee->delete();

        return back();
    }

    public function massDestroy(MassDestroyServiceEmployeeRequest $request)
    {
        $serviceEmployees = ServiceEmployee::find(request('ids'));

        foreach ($serviceEmployees as $serviceEmployee) {
            $serviceEmployee->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
