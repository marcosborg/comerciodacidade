<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\IfthenPay;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\Response;

class PaymentMethodController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('payment_method_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $company = User::find(auth()->user()->id)->company[0];

        $ifthen_pay = IfthenPay::where('company_id', $company->id)->first();

        if (!$ifthen_pay) {
            $ifthen_pay = new IfthenPay;
            $ifthen_pay->company_id = $company->id;
            $ifthen_pay->mb_antiphishing = Str::random(45);
            $ifthen_pay->mbway_antiphishing = Str::random(45);
            $ifthen_pay->save();
        }

        return view('admin.paymentMethods.index', compact('ifthen_pay', 'company'));
    }

    public function update(Request $request)
    {
        return $request;
    }

}