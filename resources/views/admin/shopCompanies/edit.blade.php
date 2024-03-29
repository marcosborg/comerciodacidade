@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.shopCompany.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.shop-companies.update", [$shopCompany->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="company_id">{{ trans('cruds.shopCompany.fields.company') }}</label>
                <select class="form-control select2 {{ $errors->has('company') ? 'is-invalid' : '' }}" name="company_id" id="company_id" required>
                    @foreach($companies as $id => $entry)
                        <option value="{{ $id }}" {{ (old('company_id') ? old('company_id') : $shopCompany->company->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('company'))
                    <span class="text-danger">{{ $errors->first('company') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.shopCompany.fields.company_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="about">{{ trans('cruds.shopCompany.fields.about') }}</label>
                <textarea class="form-control ckeditor {{ $errors->has('about') ? 'is-invalid' : '' }}" name="about" id="about">{!! old('about', $shopCompany->about) !!}</textarea>
                @if($errors->has('about'))
                    <span class="text-danger">{{ $errors->first('about') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.shopCompany.fields.about_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="shop_location_id">{{ trans('cruds.shopCompany.fields.shop_location') }}</label>
                <select class="form-control select2 {{ $errors->has('shop_location') ? 'is-invalid' : '' }}" name="shop_location_id" id="shop_location_id" required>
                    @foreach($shop_locations as $id => $entry)
                        <option value="{{ $id }}" {{ (old('shop_location_id') ? old('shop_location_id') : $shopCompany->shop_location->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('shop_location'))
                    <span class="text-danger">{{ $errors->first('shop_location') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.shopCompany.fields.shop_location_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="shop_categories">{{ trans('cruds.shopCompany.fields.shop_categories') }}</label>
                <div style="padding-bottom: 4px">
                    <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                    <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                </div>
                <select class="form-control select2 {{ $errors->has('shop_categories') ? 'is-invalid' : '' }}" name="shop_categories[]" id="shop_categories" multiple>
                    @foreach($shop_categories as $id => $shop_category)
                        <option value="{{ $id }}" {{ (in_array($id, old('shop_categories', [])) || $shopCompany->shop_categories->contains($id)) ? 'selected' : '' }}>{{ $shop_category }}</option>
                    @endforeach
                </select>
                @if($errors->has('shop_categories'))
                    <span class="text-danger">{{ $errors->first('shop_categories') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.shopCompany.fields.shop_categories_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="address">{{ trans('cruds.shopCompany.fields.address') }}</label>
                <input class="form-control {{ $errors->has('address') ? 'is-invalid' : '' }}" type="text" name="address" id="address" value="{{ old('address', $shopCompany->address) }}">
                @if($errors->has('address'))
                    <span class="text-danger">{{ $errors->first('address') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.shopCompany.fields.address_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="latitude">{{ trans('cruds.shopCompany.fields.latitude') }}</label>
                <input class="form-control {{ $errors->has('latitude') ? 'is-invalid' : '' }}" type="text" name="latitude" id="latitude" value="{{ old('latitude', $shopCompany->latitude) }}">
                @if($errors->has('latitude'))
                    <span class="text-danger">{{ $errors->first('latitude') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.shopCompany.fields.latitude_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="longitude">{{ trans('cruds.shopCompany.fields.longitude') }}</label>
                <input class="form-control {{ $errors->has('longitude') ? 'is-invalid' : '' }}" type="text" name="longitude" id="longitude" value="{{ old('longitude', $shopCompany->longitude) }}">
                @if($errors->has('longitude'))
                    <span class="text-danger">{{ $errors->first('longitude') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.shopCompany.fields.longitude_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="contacts">{{ trans('cruds.shopCompany.fields.contacts') }}</label>
                <textarea class="form-control ckeditor {{ $errors->has('contacts') ? 'is-invalid' : '' }}" name="contacts" id="contacts">{!! old('contacts', $shopCompany->contacts) !!}</textarea>
                @if($errors->has('contacts'))
                    <span class="text-danger">{{ $errors->first('contacts') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.shopCompany.fields.contacts_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="whatsapp">{{ trans('cruds.shopCompany.fields.whatsapp') }}</label>
                <input class="form-control {{ $errors->has('whatsapp') ? 'is-invalid' : '' }}" type="text" name="whatsapp" id="whatsapp" value="{{ old('whatsapp', $shopCompany->whatsapp) }}">
                @if($errors->has('whatsapp'))
                    <span class="text-danger">{{ $errors->first('whatsapp') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.shopCompany.fields.whatsapp_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="youtube">{{ trans('cruds.shopCompany.fields.youtube') }}</label>
                <input class="form-control {{ $errors->has('youtube') ? 'is-invalid' : '' }}" type="text" name="youtube" id="youtube" value="{{ old('youtube', $shopCompany->youtube) }}">
                @if($errors->has('youtube'))
                    <span class="text-danger">{{ $errors->first('youtube') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.shopCompany.fields.youtube_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="photos">{{ trans('cruds.shopCompany.fields.photos') }}</label>
                <div class="needsclick dropzone {{ $errors->has('photos') ? 'is-invalid' : '' }}" id="photos-dropzone">
                </div>
                @if($errors->has('photos'))
                    <span class="text-danger">{{ $errors->first('photos') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.shopCompany.fields.photos_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="delivery_company">{{ trans('cruds.shopCompany.fields.delivery_company') }}</label>
                <input class="form-control {{ $errors->has('delivery_company') ? 'is-invalid' : '' }}" type="text" name="delivery_company" id="delivery_company" value="{{ old('delivery_company', $shopCompany->delivery_company) }}">
                @if($errors->has('delivery_company'))
                    <span class="text-danger">{{ $errors->first('delivery_company') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.shopCompany.fields.delivery_company_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="minimum_delivery_value">{{ trans('cruds.shopCompany.fields.minimum_delivery_value') }}</label>
                <input class="form-control {{ $errors->has('minimum_delivery_value') ? 'is-invalid' : '' }}" type="number" name="minimum_delivery_value" id="minimum_delivery_value" value="{{ old('minimum_delivery_value', $shopCompany->minimum_delivery_value) }}" step="0.01">
                @if($errors->has('minimum_delivery_value'))
                    <span class="text-danger">{{ $errors->first('minimum_delivery_value') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.shopCompany.fields.minimum_delivery_value_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="delivery_free_after">{{ trans('cruds.shopCompany.fields.delivery_free_after') }}</label>
                <input class="form-control {{ $errors->has('delivery_free_after') ? 'is-invalid' : '' }}" type="number" name="delivery_free_after" id="delivery_free_after" value="{{ old('delivery_free_after', $shopCompany->delivery_free_after) }}" step="0.01">
                @if($errors->has('delivery_free_after'))
                    <span class="text-danger">{{ $errors->first('delivery_free_after') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.shopCompany.fields.delivery_free_after_helper') }}</span>
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

@section('scripts')
<script>
    $(document).ready(function () {
  function SimpleUploadAdapter(editor) {
    editor.plugins.get('FileRepository').createUploadAdapter = function(loader) {
      return {
        upload: function() {
          return loader.file
            .then(function (file) {
              return new Promise(function(resolve, reject) {
                // Init request
                var xhr = new XMLHttpRequest();
                xhr.open('POST', '{{ route('admin.shop-companies.storeCKEditorImages') }}', true);
                xhr.setRequestHeader('x-csrf-token', window._token);
                xhr.setRequestHeader('Accept', 'application/json');
                xhr.responseType = 'json';

                // Init listeners
                var genericErrorText = `Couldn't upload file: ${ file.name }.`;
                xhr.addEventListener('error', function() { reject(genericErrorText) });
                xhr.addEventListener('abort', function() { reject() });
                xhr.addEventListener('load', function() {
                  var response = xhr.response;

                  if (!response || xhr.status !== 201) {
                    return reject(response && response.message ? `${genericErrorText}\n${xhr.status} ${response.message}` : `${genericErrorText}\n ${xhr.status} ${xhr.statusText}`);
                  }

                  $('form').append('<input type="hidden" name="ck-media[]" value="' + response.id + '">');

                  resolve({ default: response.url });
                });

                if (xhr.upload) {
                  xhr.upload.addEventListener('progress', function(e) {
                    if (e.lengthComputable) {
                      loader.uploadTotal = e.total;
                      loader.uploaded = e.loaded;
                    }
                  });
                }

                // Send request
                var data = new FormData();
                data.append('upload', file);
                data.append('crud_id', '{{ $shopCompany->id ?? 0 }}');
                xhr.send(data);
              });
            })
        }
      };
    }
  }

  var allEditors = document.querySelectorAll('.ckeditor');
  for (var i = 0; i < allEditors.length; ++i) {
    ClassicEditor.create(
      allEditors[i], {
        extraPlugins: [SimpleUploadAdapter]
      }
    );
  }
});
</script>

<script>
    var uploadedPhotosMap = {}
Dropzone.options.photosDropzone = {
    url: '{{ route('admin.shop-companies.storeMedia') }}',
    maxFilesize: 2, // MB
    acceptedFiles: '.jpeg,.jpg,.png,.gif',
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 2,
      width: 4096,
      height: 4096
    },
    success: function (file, response) {
      $('form').append('<input type="hidden" name="photos[]" value="' + response.name + '">')
      uploadedPhotosMap[file.name] = response.name
    },
    removedfile: function (file) {
      console.log(file)
      file.previewElement.remove()
      var name = ''
      if (typeof file.file_name !== 'undefined') {
        name = file.file_name
      } else {
        name = uploadedPhotosMap[file.name]
      }
      $('form').find('input[name="photos[]"][value="' + name + '"]').remove()
    },
    init: function () {
@if(isset($shopCompany) && $shopCompany->photos)
      var files = {!! json_encode($shopCompany->photos) !!}
          for (var i in files) {
          var file = files[i]
          this.options.addedfile.call(this, file)
          this.options.thumbnail.call(this, file, file.preview ?? file.preview_url)
          file.previewElement.classList.add('dz-complete')
          $('form').append('<input type="hidden" name="photos[]" value="' + file.file_name + '">')
        }
@endif
    },
     error: function (file, response) {
         if ($.type(response) === 'string') {
             var message = response //dropzone sends it's own error messages in string
         } else {
             var message = response.errors.file
         }
         file.previewElement.classList.add('dz-error')
         _ref = file.previewElement.querySelectorAll('[data-dz-errormessage]')
         _results = []
         for (_i = 0, _len = _ref.length; _i < _len; _i++) {
             node = _ref[_i]
             _results.push(node.textContent = message)
         }

         return _results
     }
}

</script>
@endsection