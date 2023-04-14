<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Subscription;
use App\Models\SubscriptionPayment;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PaymentsController extends Controller
{
    public function mb(Request $request)
    {

        $subscriptionPayment = SubscriptionPayment::find($request->orderId);
        $subscriptionPayment->paid = true;
        $subscriptionPayment->save();

        $subscription = Subscription::where('id', $subscriptionPayment->subscription_id)
        ->with([
            'subscription_type'
        ])
        ->first();
        
        $start_date = $subscription->end_date;
        $months = $subscription->subscription_type->months;
        $subscription->start_date = $start_date;
        $subscription->end_date = Carbon::parse($start_date)->addMonths($months);
        $subscription->save();
        
        return $subscription;

    }

    public function mbway(Request $request)
    {

        return $request;

    }
}