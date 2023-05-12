@foreach ($shopProductVariations as $shopProductVariation)
<li class="list-group-item" data-shop-product-variation="{{ $shopProductVariation->id }}">
    <div class="row">
        <div class="col-md-5">
            <div>
                <img src="/theme/assets/img/arrows.svg" style="width: 10px; margin-right: 20px;">{{
                $shopProductVariation->name }}
            </div>
        </div>
        <div class="col-md-5">
            <input type="text" name="price" data-shop_product_variation_id="{{ $shopProductVariation->id }}"
                class="form-control" value="{{ $shopProductVariation->price }}">
        </div>
        <div class="col-md-2 text-right">
            <button onclick="deleteShopProductVariation({{ $shopProductVariation->id }})" type="button"
                class="btn btn-sm bg-transparent">
                <span class="text-muted"><i class="fas fa-trash"></i></span>
            </button>
        </div>
    </div>
</li>
@endforeach