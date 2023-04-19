<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyShopProductRequest;
use App\Http\Requests\StoreShopProductRequest;
use App\Http\Requests\UpdateShopProductRequest;
use App\Models\ShopProduct;
use App\Models\ShopTax;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class ShopProductController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('shop_product_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $shopProducts = ShopProduct::with(['tax', 'media'])->get();

        return view('admin.shopProducts.index', compact('shopProducts'));
    }

    public function create()
    {
        abort_if(Gate::denies('shop_product_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $taxes = ShopTax::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.shopProducts.create', compact('taxes'));
    }

    public function store(StoreShopProductRequest $request)
    {
        $shopProduct = ShopProduct::create($request->all());

        foreach ($request->input('photos', []) as $file) {
            $shopProduct->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('photos');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $shopProduct->id]);
        }

        return redirect()->route('admin.shop-products.index');
    }

    public function edit(ShopProduct $shopProduct)
    {
        abort_if(Gate::denies('shop_product_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $taxes = ShopTax::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $shopProduct->load('tax');

        return view('admin.shopProducts.edit', compact('shopProduct', 'taxes'));
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

        return redirect()->route('admin.shop-products.index');
    }

    public function show(ShopProduct $shopProduct)
    {
        abort_if(Gate::denies('shop_product_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $shopProduct->load('tax', 'shopProductShopProductVariations');

        return view('admin.shopProducts.show', compact('shopProduct'));
    }

    public function destroy(ShopProduct $shopProduct)
    {
        abort_if(Gate::denies('shop_product_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $shopProduct->delete();

        return back();
    }

    public function massDestroy(MassDestroyShopProductRequest $request)
    {
        $shopProducts = ShopProduct::find(request('ids'));

        foreach ($shopProducts as $shopProduct) {
            $shopProduct->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('shop_product_create') && Gate::denies('shop_product_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new ShopProduct();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}