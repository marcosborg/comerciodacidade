@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.subscriptionPayment.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.subscription-payments.update", [$subscriptionPayment->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="subscription_id">{{ trans('cruds.subscriptionPayment.fields.subscription') }}</label>
                <select class="form-control select2 {{ $errors->has('subscription') ? 'is-invalid' : '' }}" name="subscription_id" id="subscription_id" required>
                    @foreach($subscriptions as $id => $entry)
                        <option value="{{ $id }}" {{ (old('subscription_id') ? old('subscription_id') : $subscriptionPayment->subscription->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('subscription'))
                    <span class="text-danger">{{ $errors->first('subscription') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.subscriptionPayment.fields.subscription_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="value">{{ trans('cruds.subscriptionPayment.fields.value') }}</label>
                <input class="form-control {{ $errors->has('value') ? 'is-invalid' : '' }}" type="number" name="value" id="value" value="{{ old('value', $subscriptionPayment->value) }}" step="0.01" required>
                @if($errors->has('value'))
                    <span class="text-danger">{{ $errors->first('value') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.subscriptionPayment.fields.value_helper') }}</span>
            </div>
            <div class="form-group">
                <div class="form-check {{ $errors->has('paid') ? 'is-invalid' : '' }}">
                    <input type="hidden" name="paid" value="0">
                    <input class="form-check-input" type="checkbox" name="paid" id="paid" value="1" {{ $subscriptionPayment->paid || old('paid', 0) === 1 ? 'checked' : '' }}>
                    <label class="form-check-label" for="paid">{{ trans('cruds.subscriptionPayment.fields.paid') }}</label>
                </div>
                @if($errors->has('paid'))
                    <span class="text-danger">{{ $errors->first('paid') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.subscriptionPayment.fields.paid_helper') }}</span>
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