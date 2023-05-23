<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class MyServiceController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('my_service_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.myServices.index');
    }

}
