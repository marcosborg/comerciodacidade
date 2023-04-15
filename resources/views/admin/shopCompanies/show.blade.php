@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.shopCompany.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.shop-companies.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.shopCompany.fields.id') }}
                        </th>
                        <td>
                            {{ $shopCompany->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.shopCompany.fields.company') }}
                        </th>
                        <td>
                            {{ $shopCompany->company->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.shopCompany.fields.about') }}
                        </th>
                        <td>
                            {!! $shopCompany->about !!}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.shopCompany.fields.shop_location') }}
                        </th>
                        <td>
                            {{ $shopCompany->shop_location->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.shopCompany.fields.contacts') }}
                        </th>
                        <td>
                            {{ $shopCompany->contacts }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.shopCompany.fields.photos') }}
                        </th>
                        <td>
                            @foreach($shopCompany->photos as $key => $media)
                                <a href="{{ $media->getUrl() }}" target="_blank" style="display: inline-block">
                                    <img src="{{ $media->getUrl('thumb') }}">
                                </a>
                            @endforeach
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.shop-companies.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection