@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.ifthenPay.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.ifthen-pays.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="company_id">{{ trans('cruds.ifthenPay.fields.company') }}</label>
                <select class="form-control select2 {{ $errors->has('company') ? 'is-invalid' : '' }}" name="company_id" id="company_id" required>
                    @foreach($companies as $id => $entry)
                        <option value="{{ $id }}" {{ old('company_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('company'))
                    <span class="text-danger">{{ $errors->first('company') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.ifthenPay.fields.company_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="mb_key">{{ trans('cruds.ifthenPay.fields.mb_key') }}</label>
                <input class="form-control {{ $errors->has('mb_key') ? 'is-invalid' : '' }}" type="text" name="mb_key" id="mb_key" value="{{ old('mb_key', '') }}">
                @if($errors->has('mb_key'))
                    <span class="text-danger">{{ $errors->first('mb_key') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.ifthenPay.fields.mb_key_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="mbway_key">{{ trans('cruds.ifthenPay.fields.mbway_key') }}</label>
                <input class="form-control {{ $errors->has('mbway_key') ? 'is-invalid' : '' }}" type="text" name="mbway_key" id="mbway_key" value="{{ old('mbway_key', '') }}">
                @if($errors->has('mbway_key'))
                    <span class="text-danger">{{ $errors->first('mbway_key') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.ifthenPay.fields.mbway_key_helper') }}</span>
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