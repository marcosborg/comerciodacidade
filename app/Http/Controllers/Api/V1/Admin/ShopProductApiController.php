<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StoreShopProductRequest;
use App\Http\Requests\UpdateShopProductRequest;
use App\Http\Resources\Admin\ShopProductResource;
use App\Models\ShopProduct;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ShopProductApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        //abort_if(Gate::denies('shop_product_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new ShopProductResource(ShopProduct::with(['tax'])->get());
    }

    public function store(StoreShopProductRequest $request)
    {
        $shopProduct = ShopProduct::create($request->all());

        foreach ($request->input('photos', []) as $file) {
            $shopProduct->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('photos');
        }

        return (new ShopProductResource($shopProduct))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(ShopProduct $shopProduct)
    {
        abort_if(Gate::denies('shop_product_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new ShopProductResource($shopProduct->load(['tax']));
    }

    public function update(UpdateShopProductRequest $request, ShopProduct $shopProduct)
    {
        $shopProduct->update($request->all());

        if (count($shopProduct->photos) > 0) {
            foreach ($shopProduct->photos as $media) {
                if (! in_array($media->file_name, $request->input('photos', []))) {
                    $media->delete();
                }
            }
        }
        $media = $shopProduct->photos->pluck('file_name')->toArray();
        foreach ($request->input('photos', []) as $file) {
            if (count($media) === 0 || ! in_array($file, $media)) {
                $shopProduct->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('photos');
            }
        }

        return (new ShopProductResource($shopProduct))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(ShopProduct $shopProduct)
    {
        abort_if(Gate::denies('shop_product_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $shopProduct->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}