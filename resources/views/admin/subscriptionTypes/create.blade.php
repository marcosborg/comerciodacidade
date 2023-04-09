@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.subscriptionType.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.subscription-types.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="months">{{ trans('cruds.subscriptionType.fields.months') }}</label>
                <input class="form-control {{ $errors->has('months') ? 'is-invalid' : '' }}" type="number" name="months" id="months" value="{{ old('months', '') }}" step="1">
                @if($errors->has('months'))
                    <span class="text-danger">{{ $errors->first('months') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.subscriptionType.fields.months_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="discount">{{ trans('cruds.subscriptionType.fields.discount') }}</label>
                <input class="form-control {{ $errors->has('discount') ? 'is-invalid' : '' }}" type="number" name="discount" id="discount" value="{{ old('discount', '0') }}" step="1" required>
                @if($errors->has('discount'))
                    <span class="text-danger">{{ $errors->first('discount') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.subscriptionType.fields.discount_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="plans">{{ trans('cruds.subscriptionType.fields.plans') }}</label>
                <div style="padding-bottom: 4px">
                    <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                    <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                </div>
                <select class="form-control select2 {{ $errors->has('plans') ? 'is-invalid' : '' }}" name="plans[]" id="plans" multiple required>
                    @foreach($plans as $id => $plan)
                        <option value="{{ $id }}" {{ in_array($id, old('plans', [])) ? 'selected' : '' }}>{{ $plan }}</option>
                    @endforeach
                </select>
                @if($errors->has('plans'))
                    <span class="text-danger">{{ $errors->first('plans') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.subscriptionType.fields.plans_helper') }}</span>
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