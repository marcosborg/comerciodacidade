@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.purchase.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.purchases.update", [$purchase->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required">{{ trans('cruds.purchase.fields.type') }}</label>
                @foreach(App\Models\Purchase::TYPE_RADIO as $key => $label)
                    <div class="form-check {{ $errors->has('type') ? 'is-invalid' : '' }}">
                        <input class="form-check-input" type="radio" id="type_{{ $key }}" name="type" value="{{ $key }}" {{ old('type', $purchase->type) === (string) $key ? 'checked' : '' }} required>
                        <label class="form-check-label" for="type_{{ $key }}">{{ $label }}</label>
                    </div>
                @endforeach
                @if($errors->has('type'))
                    <span class="text-danger">{{ $errors->first('type') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.purchase.fields.type_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="relationship">{{ trans('cruds.purchase.fields.relationship') }}</label>
                <input class="form-control {{ $errors->has('relationship') ? 'is-invalid' : '' }}" type="number" name="relationship" id="relationship" value="{{ old('relationship', $purchase->relationship) }}" step="1" required>
                @if($errors->has('relationship'))
                    <span class="text-danger">{{ $errors->first('relationship') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.purchase.fields.relationship_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="name">{{ trans('cruds.purchase.fields.name') }}</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', $purchase->name) }}">
                @if($errors->has('name'))
                    <span class="text-danger">{{ $errors->first('name') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.purchase.fields.name_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="price">{{ trans('cruds.purchase.fields.price') }}</label>
                <input class="form-control {{ $errors->has('price') ? 'is-invalid' : '' }}" type="number" name="price" id="price" value="{{ old('price', $purchase->price) }}" step="0.01">
                @if($errors->has('price'))
                    <span class="text-danger">{{ $errors->first('price') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.purchase.fields.price_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="vat">{{ trans('cruds.purchase.fields.vat') }}</label>
                <input class="form-control {{ $errors->has('vat') ? 'is-invalid' : '' }}" type="number" name="vat" id="vat" value="{{ old('vat', $purchase->vat) }}" step="0.01">
                @if($errors->has('vat'))
                    <span class="text-danger">{{ $errors->first('vat') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.purchase.fields.vat_helper') }}</span>
            </div>
            <div class="form-group">
                <div class="form-check {{ $errors->has('status') ? 'is-invalid' : '' }}">
                    <input type="hidden" name="status" value="0">
                    <input class="form-check-input" type="checkbox" name="status" id="status" value="1" {{ $purchase->status || old('status', 0) === 1 ? 'checked' : '' }}>
                    <label class="form-check-label" for="status">{{ trans('cruds.purchase.fields.status') }}</label>
                </div>
                @if($errors->has('status'))
                    <span class="text-danger">{{ $errors->first('status') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.purchase.fields.status_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="user_id">{{ trans('cruds.purchase.fields.user') }}</label>
                <select class="form-control select2 {{ $errors->has('user') ? 'is-invalid' : '' }}" name="user_id" id="user_id" required>
                    @foreach($users as $id => $entry)
                        <option value="{{ $id }}" {{ (old('user_id') ? old('user_id') : $purchase->user->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('user'))
                    <span class="text-danger">{{ $errors->first('user') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.purchase.fields.user_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="total">{{ trans('cruds.purchase.fields.total') }}</label>
                <input class="form-control {{ $errors->has('total') ? 'is-invalid' : '' }}" type="number" name="total" id="total" value="{{ old('total', $purchase->total) }}" step="0.01">
                @if($errors->has('total'))
                    <span class="text-danger">{{ $errors->first('total') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.purchase.fields.total_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="qty">{{ trans('cruds.purchase.fields.qty') }}</label>
                <input class="form-control {{ $errors->has('qty') ? 'is-invalid' : '' }}" type="number" name="qty" id="qty" value="{{ old('qty', $purchase->qty) }}" step="1">
                @if($errors->has('qty'))
                    <span class="text-danger">{{ $errors->first('qty') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.purchase.fields.qty_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="cart">{{ trans('cruds.purchase.fields.cart') }}</label>
                <textarea class="form-control {{ $errors->has('cart') ? 'is-invalid' : '' }}" name="cart" id="cart">{{ old('cart', $purchase->cart) }}</textarea>
                @if($errors->has('cart'))
                    <span class="text-danger">{{ $errors->first('cart') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.purchase.fields.cart_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="address">{{ trans('cruds.purchase.fields.address') }}</label>
                <textarea class="form-control {{ $errors->has('address') ? 'is-invalid' : '' }}" name="address" id="address">{{ old('address', $purchase->address) }}</textarea>
                @if($errors->has('address'))
                    <span class="text-danger">{{ $errors->first('address') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.purchase.fields.address_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="method">{{ trans('cruds.purchase.fields.method') }}</label>
                <input class="form-control {{ $errors->has('method') ? 'is-invalid' : '' }}" type="text" name="method" id="method" value="{{ old('method', $purchase->method) }}">
                @if($errors->has('method'))
                    <span class="text-danger">{{ $errors->first('method') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.purchase.fields.method_helper') }}</span>
            </div>
            <div class="form-group">
                <div class="form-check {{ $errors->has('payed') ? 'is-invalid' : '' }}">
                    <input type="hidden" name="payed" value="0">
                    <input class="form-check-input" type="checkbox" name="payed" id="payed" value="1" {{ $purchase->payed || old('payed', 0) === 1 ? 'checked' : '' }}>
                    <label class="form-check-label" for="payed">{{ trans('cruds.purchase.fields.payed') }}</label>
                </div>
                @if($errors->has('payed'))
                    <span class="text-danger">{{ $errors->first('payed') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.purchase.fields.payed_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="internal">{{ trans('cruds.purchase.fields.internal') }}</label>
                <input class="form-control {{ $errors->has('internal') ? 'is-invalid' : '' }}" type="number" name="internal" id="internal" value="{{ old('internal', $purchase->internal) }}" step="1">
                @if($errors->has('internal'))
                    <span class="text-danger">{{ $errors->first('internal') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.purchase.fields.internal_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="company_id">{{ trans('cruds.purchase.fields.company') }}</label>
                <select class="form-control select2 {{ $errors->has('company') ? 'is-invalid' : '' }}" name="company_id" id="company_id">
                    @foreach($companies as $id => $entry)
                        <option value="{{ $id }}" {{ (old('company_id') ? old('company_id') : $purchase->company->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('company'))
                    <span class="text-danger">{{ $errors->first('company') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.purchase.fields.company_helper') }}</span>
            </div>
            <div class="form-group">
                <button class="btn btn-danger" type="submit">
                    {{ trans('global.save') }}
                </button>
            </div>
        </form>
    </div>
</div>



@endsection