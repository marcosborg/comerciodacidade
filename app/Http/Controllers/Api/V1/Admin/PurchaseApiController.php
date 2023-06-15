<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePurchaseRequest;
use App\Http\Requests\UpdatePurchaseRequest;
use App\Http\Resources\Admin\PurchaseResource;
use App\Models\Purchase;
use App\Models\ShopSchedule;
use Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class PurchaseApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('purchase_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new PurchaseResource(Purchase::with(['user'])->get());
    }

    public function store(StorePurchaseRequest $request)
    {
        $purchase = Purchase::create($request->all());

        return (new PurchaseResource($purchase))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Purchase $purchase)
    {
        abort_if(Gate::denies('purchase_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new PurchaseResource($purchase->load(['user']));
    }

    public function update(UpdatePurchaseRequest $request, Purchase $purchase)
    {
        $purchase->update($request->all());

        return (new PurchaseResource($purchase))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Purchase $purchase)
    {
        abort_if(Gate::denies('purchase_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $purchase->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function lastPurchases(Request $request)
    {
        $client_id = Auth::guard('sanctum')->user()->id;

        $shop_schedules = ShopSchedule::where('client_id', $client_id)
            ->get()
            ->load([
                'service_employee.shop_company.company',
                'service'
            ]);

        $purchases = Purchase::where([
            'type' => 'product',
            'user_id' => $client_id
        ])->get()->load('product.shop_product_categories.company');

        return [
            'schedules' => $shop_schedules,
            'purchases' => $purchases
        ];
    }
}