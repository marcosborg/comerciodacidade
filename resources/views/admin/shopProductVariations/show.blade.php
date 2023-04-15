@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.shopProductVariation.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.shop-product-variations.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.shopProductVariation.fields.id') }}
                        </th>
                        <td>
                            {{ $shopProductVariation->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.shopProductVariation.fields.shop_product') }}
                        </th>
                        <td>
                            {{ $shopProductVariation->shop_product->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.shopProductVariation.fields.name') }}
                        </th>
                        <td>
                            {{ $shopProductVariation->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.shopProductVariation.fields.price') }}
                        </th>
                        <td>
                            {{ $shopProductVariation->price }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.shop-product-variations.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection