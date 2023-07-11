<div class="card mb-5">
    <div class="card-header">
        Pesquisar nas lojas
    </div>
    <div class="card-body">
        <div class="input-group mb-3">
            <input type="text" class="form-control" placeholder="O que procura?">
            <button class="btn btn-orange" type="button"><i class="bi bi-search"></i></button>
        </div>
        <div class="list-group">
            @foreach ($shop_categories as $shop_category)
            <a href="/lojas/categoria/{{ $shop_category->id }}/{{ Str::slug($shop_category->name, '-') }}" class="list-group-item list-group-item-action {{ isset($category) && $category->id == $shop_category->id ?
                                'active' : '' }}">{{ $shop_category->name
                }}</a>
            @endforeach
        </div>
    </div>
</div>