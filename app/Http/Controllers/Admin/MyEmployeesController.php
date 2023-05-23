<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyMyEmployeeRequest;
use App\Http\Requests\StoreMyEmployeeRequest;
use App\Http\Requests\UpdateMyEmployeeRequest;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class MyEmployeesController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('my_employee_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.myEmployees.index');
    }

    public function create()
    {
        abort_if(Gate::denies('my_employee_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.myEmployees.create');
    }

    public function store(StoreMyEmployeeRequest $request)
    {
        $myEmployee = MyEmployee::create($request->all());

        return redirect()->route('admin.my-employees.index');
    }

    public function edit(MyEmployee $myEmployee)
    {
        abort_if(Gate::denies('my_employee_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.myEmployees.edit', compact('myEmployee'));
    }

    public function update(UpdateMyEmployeeRequest $request, MyEmployee $myEmployee)
    {
        $myEmployee->update($request->all());

        return redirect()->route('admin.my-employees.index');
    }

    public function show(MyEmployee $myEmployee)
    {
        abort_if(Gate::denies('my_employee_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.myEmployees.show', compact('myEmployee'));
    }

    public function destroy(MyEmployee $myEmployee)
    {
        abort_if(Gate::denies('my_employee_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $myEmployee->delete();

        return back();
    }

    public function massDestroy(MassDestroyMyEmployeeRequest $request)
    {
        $myEmployees = MyEmployee::find(request('ids'));

        foreach ($myEmployees as $myEmployee) {
            $myEmployee->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
