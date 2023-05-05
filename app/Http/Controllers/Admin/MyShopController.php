<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StoreShopCompanyRequest;
use App\Http\Requests\UpdateShopCompanyRequest;
use App\Models\ShopCategory;
use App\Models\ShopCompany;
use App\Models\ShopLocation;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class MyShopController extends Controller
{

    use MediaUploadingTrait;

    public function index(ShopCompany $shopCompany)
    {
        abort_if(Gate::denies('my_shop_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $user = User::where('id', auth()->user()->id)
            ->with([
                'subscription.subscription_type.plan',
                'subscription.subscriptionPayments.subscription.subscription_type.plan',
                'company.shop_company'
            ])->first();

        $shop_locations = ShopLocation::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $shop_categories = ShopCategory::pluck('name', 'id');

        return view('admin.myShops.index', compact('user', 'shopCompany', 'shop_categories', 'shop_locations'));
    }

    public function create()
    {
        abort_if(Gate::denies('my_shop_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $company = User::where('id', auth()->user()->id)->with('company')->first()->company[0];

        $shop_locations = ShopLocation::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $shop_categories = ShopCategory::pluck('name', 'id');

        return view('admin.myShops.create', compact('company', 'shop_categories', 'shop_locations'));

    }

    public function store(StoreShopCompanyRequest $request)
    {
        $shopCompany = ShopCompany::create($request->all());
        $shopCompany->shop_categories()->sync($request->input('shop_categories', []));
        foreach ($request->input('photos', []) as $file) {
            $shopCompany->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('photos');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $shopCompany->id]);
        }

        return redirect()->route('admin.my-shops.index');
    }

    public function update(UpdateShopCompanyRequest $request, ShopCompany $shopCompany)
    {
        
        $shopCompanyUpdate = ShopCompany::find($request->id);
        $shopCompanyUpdate->about = $request->about;
        $shopCompanyUpdate->contacts = $request->contacts;

        $shopCompanyUpdate->shop_categories()->sync($request->shop_categories);

        $shopCompanyUpdate->save();
        
        if (count($shopCompanyUpdate->photos) > 0) {
            foreach ($shopCompanyUpdate->photos as $media) {
                if (! in_array($media->file_name, $request->input('photos', []))) {
                    $media->delete();
                }
            }
        }
        $media = $shopCompanyUpdate->photos->pluck('file_name')->toArray();
        foreach ($request->input('photos', []) as $file) {
            if (count($media) === 0 || ! in_array($file, $media)) {
                $shopCompanyUpdate->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('photos');
            }
        }

        return redirect()->route('admin.my-shops.index')->with('message', 'Atualizado com sucesso.');
    }

}