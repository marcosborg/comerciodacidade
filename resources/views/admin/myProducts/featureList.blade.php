@foreach ($shopProductFeatures as $shopProductFeature)
<li class="list-group-item d-flex justify-content-between align-items-center">
    <div>
        <img src="/public/theme/assets/img/arrows.svg">{{ $shopProductFeature->name }}
    </div>
    <button onclick="deleteShopProductFeature({{ $shopProductFeature->id }})" type="button"
        class="btn btn-sm bg-transparent" aria-label="Remove">
        <span class="text-muted"><i class="fas fa-trash"></i></span>
    </button>
</li>
@endforeach