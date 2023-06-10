<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Models\ShopSchedule;
use Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PurchasesApiController extends Controller
{
    public function purchases(Request $request)
    {
        $client_id = Auth::guard('sanctum')->user()->id;

        $shop_schedules = ShopSchedule::where('client_id', $client_id)
            ->get()
            ->load([
                'service_employee.shop_company.company',
                'service'
            ]);

        return $shop_schedules;
    }
}