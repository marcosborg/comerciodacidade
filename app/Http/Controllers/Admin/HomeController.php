<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\Plan;
use App\Models\User;

class HomeController
{
    public function index()
    {
        $user = User::where('id', auth()->user()->id)
            ->with([
                'subscription.subscription_type.plan',
                'subscription.subscriptionPayments'
            ])->first();

        $plans = Plan::with([
            'subscriptionTypes'
        ])
            ->get();

        return view('home')->with([
            'plans' => $plans,
            'user' => $user
        ]);
    }

    public function teste(Request $request)
    {
        return $request;
    }
}