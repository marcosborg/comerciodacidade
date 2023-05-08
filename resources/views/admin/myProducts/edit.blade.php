@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.myProduct.title_singular') }}
    </div>

    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <form method="POST" action="{{ route("admin.shop-products.update", [$shopProduct->id]) }}"
                    enctype="multipart/form-data">
                    @method('PUT')
                    @csrf
                    <input type="hidden" name="myProduct" value="1">
                    <div class="form-group">
                        <label class="required" for="name">{{ trans('cruds.shopProduct.fields.name') }}</label>
                        <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text"
                            name="name" id="name" value="{{ old('name', $shopProduct->name) }}" required>
                        @if($errors->has('name'))
                        <span class="text-danger">{{ $errors->first('name') }}</span>
                        @endif
                        <span class="help-block">{{ trans('cruds.shopProduct.fields.name_helper') }}</span>
                    </div>
                    <div class="form-group">
                        <label for="reference">{{ trans('cruds.shopProduct.fields.reference') }}</label>
                        <input class="form-control {{ $errors->has('reference') ? 'is-invalid' : '' }}" type="text"
                            name="reference" id="reference" value="{{ old('reference', $shopProduct->reference) }}">
                        @if($errors->has('reference'))
                        <span class="text-danger">{{ $errors->first('reference') }}</span>
                        @endif
                        <span class="help-block">{{ trans('cruds.shopProduct.fields.reference_helper') }}</span>
                    </div>
                    <div class="form-group">
                        <label for="description">{{ trans('cruds.shopProduct.fields.description') }}</label>
                        <textarea class="form-control ckeditor {{ $errors->has('description') ? 'is-invalid' : '' }}"
                            name="description"
                            id="description">{!! old('description', $shopProduct->description) !!}</textarea>
                        @if($errors->has('description'))
                        <span class="text-danger">{{ $errors->first('description') }}</span>
                        @endif
                        <span class="help-block">{{ trans('cruds.shopProduct.fields.description_helper') }}</span>
                    </div>
                    <div class="form-group">
                        <label for="photos">{{ trans('cruds.shopProduct.fields.photos') }}</label>
                        <div class="needsclick dropzone {{ $errors->has('photos') ? 'is-invalid' : '' }}"
                            id="photos-dropzone">
                        </div>
                        @if($errors->has('photos'))
                        <span class="text-danger">{{ $errors->first('photos') }}</span>
                        @endif
                        <span class="help-block">{{ trans('cruds.shopProduct.fields.photos_helper') }}</span>
                    </div>
                    <div class="form-group">
                        <label for="shop_product_categories">{{
                            trans('cruds.shopProduct.fields.shop_product_categories') }}</label>
                        <div style="padding-bottom: 4px">
                            <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{
                                trans('global.select_all') }}</span>
                            <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{
                                trans('global.deselect_all') }}</span>
                        </div>
                        <select
                            class="form-control select2 {{ $errors->has('shop_product_categories') ? 'is-invalid' : '' }}"
                            name="shop_product_categories[]" id="shop_product_categories" multiple>
                            @foreach($shop_product_categories as $id => $shop_product_category)
                            <option value="{{ $id }}" {{ (in_array($id, old('shop_product_categories', [])) ||
                                $shopProduct->shop_product_categories->contains($id)) ? 'selected' : '' }}>{{
                                $shop_product_category }}</option>
                            @endforeach
                        </select>
                        @if($errors->has('shop_product_categories'))
                        <span class="text-danger">{{ $errors->first('shop_product_categories') }}</span>
                        @endif
                        <span class="help-block">{{ trans('cruds.shopProduct.fields.shop_product_categories_helper')
                            }}</span>
                    </div>
                    <div class="form-group">
                        <label for="shop_product_sub_categories">{{
                            trans('cruds.shopProduct.fields.shop_product_sub_categories') }}</label>
                        <div style="padding-bottom: 4px">
                            <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{
                                trans('global.select_all') }}</span>
                            <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{
                                trans('global.deselect_all') }}</span>
                        </div>
                        <select
                            class="form-control select2 {{ $errors->has('shop_product_sub_categories') ? 'is-invalid' : '' }}"
                            name="shop_product_sub_categories[]" id="shop_product_sub_categories" multiple>
                            @foreach($shop_product_sub_categories as $id => $shop_product_sub_category)
                            <option value="{{ $id }}" {{ (in_array($id, old('shop_product_sub_categories', [])) ||
                                $shopProduct->shop_product_sub_categories->contains($id)) ? 'selected' : '' }}>{{
                                $shop_product_sub_category }}</option>
                            @endforeach
                        </select>
                        @if($errors->has('shop_product_sub_categories'))
                        <span class="text-danger">{{ $errors->first('shop_product_sub_categories') }}</span>
                        @endif
                        <span class="help-block">{{ trans('cruds.shopProduct.fields.shop_product_sub_categories_helper')
                            }}</span>
                    </div>
                    <div class="form-group">
                        <label for="price">{{ trans('cruds.shopProduct.fields.price') }}</label>
                        <input class="form-control {{ $errors->has('price') ? 'is-invalid' : '' }}" type="number"
                            name="price" id="price" value="{{ old('price', $shopProduct->price) }}" step="0.01">
                        @if($errors->has('price'))
                        <span class="text-danger">{{ $errors->first('price') }}</span>
                        @endif
                        <span class="help-block">{{ trans('cruds.shopProduct.fields.price_helper') }}</span>
                    </div>
                    <div class="form-group">
                        <label class="required" for="tax_id">{{ trans('cruds.shopProduct.fields.tax') }}</label>
                        <select class="form-control select2 {{ $errors->has('tax') ? 'is-invalid' : '' }}" name="tax_id"
                            id="tax_id" required>
                            @foreach($taxes as $id => $entry)
                            <option value="{{ $id }}" {{ (old('tax_id') ? old('tax_id') : $shopProduct->tax->id ?? '')
                                == $id ? 'selected' : '' }}>{{ $entry }}</option>
                            @endforeach
                        </select>
                        @if($errors->has('tax'))
                        <span class="text-danger">{{ $errors->first('tax') }}</span>
                        @endif
                        <span class="help-block">{{ trans('cruds.shopProduct.fields.tax_helper') }}</span>
                    </div>
                    <div class="form-group">
                        <div class="form-check {{ $errors->has('state') ? 'is-invalid' : '' }}">
                            <input type="hidden" name="state" value="0">
                            <input class="form-check-input" type="checkbox" name="state" id="state" value="1" {{
                                $shopProduct->state || old('state', 0) === 1 ? 'checked' : '' }}>
                            <label class="form-check-label" for="state">{{ trans('cruds.shopProduct.fields.state')
                                }}</label>
                        </div>
                        @if($errors->has('state'))
                        <span class="text-danger">{{ $errors->first('state') }}</span>
                        @endif
                        <span class="help-block">{{ trans('cruds.shopProduct.fields.state_helper') }}</span>
                    </div>
                    <div class="form-group">
                        <button class="btn btn-danger" type="submit">
                            {{ trans('global.save') }}
                        </button>
                    </div>
                </form>
            </div>
            <div class="col-md-6">
                <form action="/admin/my-products/new-shop-product-feature" method="post" id="shop_product_feature_form">
                    @csrf
                    <input type="hidden" name="shop_product_id" value="{{ $shopProduct->id }}">
                    <div class="form-group">
                        <label>Caracteristicas do produto</label>
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" placeholder="Nova caracteristica" name="name"
                                required>
                            <div class="input-group-append">
                                <button class="btn btn-secondary" type="submit" id="button-addon2">Inserir
                                    caracteristica</button>
                            </div>
                        </div>
                    </div>
                </form>
                <ul class="list-group" id="shop_product_feature_list"></ul>
                <form action="/admin/my-products/new-shop-product-variation" method="post"
                    id="shop_product_variation_form">
                    @csrf
                    <input type="hidden" name="shop_product_id" value="{{ $shopProduct->id }}">
                    <div class="form-group mt-4">
                        <label>Variações do produto</label>
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" placeholder="Nova variação" name="name" required>
                            <div class="input-group-append">
                                <button class="btn btn-secondary" type="submit" id="button-addon2">Inserir
                                    variação</button>
                            </div>
                        </div>
                    </div>
                </form>
                <ul class="list-group list-group-flush" id="shop_product_variation_list">

                </ul>
                <button type="button" class="btn btn-secondary mt-4 float-right"
                    onclick="updateShopProductVariationPrices()">Gravar alterações às variações</button>
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')
@parent
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
                xhr.open('POST', '{{ route('admin.shop-products.storeCKEditorImages') }}', true);
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
                data.append('crud_id', '{{ $shopProduct->id ?? 0 }}');
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
    url: '{{ route('admin.shop-products.storeMedia') }}',
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
@if(isset($shopProduct) && $shopProduct->photos)
      var files = {!! json_encode($shopProduct->photos) !!}
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
<script src="https://malsup.github.io/jquery.form.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdn.jsdelivr.net/npm/gasparesganga-jquery-loading-overlay@2.1.7/dist/loadingoverlay.min.js">
</script>
<script>
    $(() => {
        shopProductFeatureList();
        $('#shop_product_feature_form').ajaxForm({
            beforeSubmit: () => {
                $.LoadingOverlay('show');
            },
            success: () => {
                $.LoadingOverlay('hide');
                $('#shop_product_feature_form input[name=name]').val('');
                shopProductFeatureList();
            },
            error: (error) => {
                $.LoadingOverlay('hide');
                console.log(error);
            }
        });
    });
    shopProductFeatureList = () => {
        $.LoadingOverlay('show');
        let shop_product_id = {!! $shopProduct->id !!};
        $.get('/admin/my-products/shop-product-feature-list/' + shop_product_id).then((resp) => {
            $.LoadingOverlay('hide');
            $('#shop_product_feature_list').html(resp);
        });
    }
    deleteShopProductFeature = (shop_product_feature_id) => {
        Swal.fire({
            title: 'Tem a certeza?',
            text: "Não é possivel reverter!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Sim, pode apagar!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.LoadingOverlay('show');
                $.get('/admin/my-products/delete-shop-product-feature/' + shop_product_feature_id).then(() => {
                    shopProductFeatureList();
                    $.LoadingOverlay('hide');
                    Swal.fire(
                        'Apagado!',
                        'Pode continuar.',
                        'success'
                    );
                });
            }
        });
    }
</script>
<script>
    $(() => {
    shopProductVariationList();
    $('#shop_product_variation_form').ajaxForm({
        beforeSubmit: () => {
            $.LoadingOverlay('show');
        },
        success: () => {
            $.LoadingOverlay('hide');
            $('#shop_product_variation_form input[name=name]').val('');
            shopProductVariationList();
        },
        error: (error) => {
            $.LoadingOverlay('hide');
            console.log(error);
        }
    });
});
shopProductVariationList = () => {
    $.LoadingOverlay('show');
    let shop_product_id = {!! $shopProduct->id !!};
    $.get('/admin/my-products/shop-product-variation-list/' + shop_product_id).then((resp) => {
        $.LoadingOverlay('hide');
        $('#shop_product_variation_list').html(resp);
    });
}
deleteShopProductVariation = (shop_product_variation_id) => {
    Swal.fire({
        title: 'Tem a certeza?',
        text: "Não é possivel reverter!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Sim, pode apagar!'
    }).then((result) => {
        if (result.isConfirmed) {
            $.LoadingOverlay('show');
            $.get('/admin/my-products/delete-shop-product-variation/' + shop_product_variation_id).then(() => {
                shopProductVariationList();
                $.LoadingOverlay('hide');
                Swal.fire(
                    'Apagado!',
                    'Pode continuar.',
                    'success'
                );
            });
        }
    });
}
updateShopProductVariationPrices = () => {
    data = [];
    $('#shop_product_variation_list input[name=price]').each(function(){
        data.push({
            shop_product_variation_id: $(this).data('shop_product_variation_id'),
            price: $(this).val()
        });
        console.log();
    });
    $.ajax({
        url: '/admin/my-products/update-shop-product-variation-prices',
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
        },
        data: {
            data: JSON.stringify(data)
        },
        success: () => {
            shopProductVariationList();
        },
        error: (err) => {
            console.log(err);
        }
    });
}
</script>
@endsection