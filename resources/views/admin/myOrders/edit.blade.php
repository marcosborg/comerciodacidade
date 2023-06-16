@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.purchase.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="/admin/my-orders/update" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="id" value="{{ $purchase->id }}">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="name">{{ trans('cruds.purchase.fields.name') }}</label>
                        <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text"
                            name="name" id="name" value="{{ old('name', $purchase->name) }}">
                        @if($errors->has('name'))
                        <span class="text-danger">{{ $errors->first('name') }}</span>
                        @endif
                        <span class="help-block">{{ trans('cruds.purchase.fields.name_helper') }}</span>
                    </div>
                    <div class="form-group">
                        <label for="price">{{ trans('cruds.purchase.fields.price') }}</label>
                        <input class="form-control {{ $errors->has('price') ? 'is-invalid' : '' }}" type="number"
                            name="price" id="price" value="{{ old('price', $purchase->price) }}" step="0.01">
                        @if($errors->has('price'))
                        <span class="text-danger">{{ $errors->first('price') }}</span>
                        @endif
                        <span class="help-block">{{ trans('cruds.purchase.fields.price_helper') }}</span>
                    </div>
                    <div class="form-group">
                        <label for="vat">{{ trans('cruds.purchase.fields.vat') }}</label>
                        <input class="form-control {{ $errors->has('vat') ? 'is-invalid' : '' }}" type="number"
                            name="vat" id="vat" value="{{ old('vat', $purchase->vat) }}" step="0.01">
                        @if($errors->has('vat'))
                        <span class="text-danger">{{ $errors->first('vat') }}</span>
                        @endif
                        <span class="help-block">{{ trans('cruds.purchase.fields.vat_helper') }}</span>
                    </div>
                    <div class="form-group">
                        <div class="form-check {{ $errors->has('status') ? 'is-invalid' : '' }}">
                            <input type="hidden" name="status" value="0">
                            <input class="form-check-input" type="checkbox" name="status" id="status" value="1" {{
                                $purchase->status || old('status', 0) === 1 ? 'checked' : '' }}>
                            <label class="form-check-label" for="status">{{ trans('cruds.purchase.fields.status')
                                }}</label>
                        </div>
                        @if($errors->has('status'))
                        <span class="text-danger">{{ $errors->first('status') }}</span>
                        @endif
                        <span class="help-block">{{ trans('cruds.purchase.fields.status_helper') }}</span>
                    </div>
                    <div class="form-group">
                        <label for="total">{{ trans('cruds.purchase.fields.total') }}</label>
                        <input class="form-control {{ $errors->has('total') ? 'is-invalid' : '' }}" type="number"
                            name="total" id="total" value="{{ old('total', $purchase->total) }}" step="0.01">
                        @if($errors->has('total'))
                        <span class="text-danger">{{ $errors->first('total') }}</span>
                        @endif
                        <span class="help-block">{{ trans('cruds.purchase.fields.total_helper') }}</span>
                    </div>
                    <div class="form-group">
                        <label for="qty">{{ trans('cruds.purchase.fields.qty') }}</label>
                        <input class="form-control {{ $errors->has('qty') ? 'is-invalid' : '' }}" type="number"
                            name="qty" id="qty" value="{{ old('qty', $purchase->qty) }}" step="1">
                        @if($errors->has('qty'))
                        <span class="text-danger">{{ $errors->first('qty') }}</span>
                        @endif
                        <span class="help-block">{{ trans('cruds.purchase.fields.qty_helper') }}</span>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Cliente</label>
                        <input type="text" value="{{ $purchase->user->name }}" class="form-control" disabled>
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input type="text" value="{{ $purchase->user->email }}" class="form-control" disabled>
                    </div>
                    <div class="form-group">
                        <label>Contacto</label>
                        <input type="text" value="{{ $purchase->user->address->phone }}" class="form-control" disabled>
                    </div>
                    <div class="form-group">
                        <label>Endereço</label>
                        <textarea class="form-control"
                            disabled>{{ $purchase->user->address->address }}, {{ $purchase->user->address->zip }}, {{ $purchase->user->address->city }}, {{ $purchase->user->address->country->name }}</textarea>
                    </div>
                </div>
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
<script>
    console.log({!! $purchase !!})
</script>