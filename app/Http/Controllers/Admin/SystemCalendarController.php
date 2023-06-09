<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\ServiceEmployee;
use App\Models\ShopSchedule;
use Carbon\Carbon;

class SystemCalendarController extends Controller
{
    public $sources = [
        [
            'model' => '\App\Models\ShopSchedule',
            'date_field' => 'start_time',
            'field' => 'id',
            'prefix' => 'Cliente',
            'suffix' => 'tem marcação',
            'route' => 'admin.shop-schedules.edit',
        ],
    ];

    public function index()
    {

        $company = Company::whereHas('users', function ($query) {
            $query->where('id', auth()->user()->id);
        })->first()->load('shop_company');

        $shop_schedules = ShopSchedule::whereHas('service_employee.shop_company', function ($query) use ($company) {
            $query->where('id', $company->shop_company->id);
        })
            ->get()
            ->load('service', 'service_employee.shop_company');

        $events = [];

        foreach ($shop_schedules as $shop_schedule) {

            $events[] = [
                'title' => $shop_schedule->client ? $shop_schedule->client->name : $shop_schedule->notes,
                'start' => $shop_schedule->start_time,
                'end' => $shop_schedule->end_time,
                'id' => $shop_schedule->id,
            ];
        }

        return view('admin.calendar.calendar', compact('events'));
    }
}