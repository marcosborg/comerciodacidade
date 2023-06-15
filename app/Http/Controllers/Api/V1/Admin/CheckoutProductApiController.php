<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Models\Purchase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckoutProductApiController extends Controller
{

    public function checkoutProduct(Request $request)
    {
        $user_id = Auth::guard('sanctum')->user()->id;
        $purchase = new Purchase;
        $purchase->type = $request->type;
        $purchase->relationship = $request->relationship;
        $purchase->name = $request->name;
        $purchase->price = $request->price;
        $purchase->vat = $request->tax;
        $purchase->status = $request->status;
        $purchase->user_id = $user_id;
        $purchase->total = $request->total;
        $purchase->qty = $request->qty;
        $purchase->save();
        
    }

}