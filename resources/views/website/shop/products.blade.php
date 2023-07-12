@extends('website.layouts.website')
@section('header')
<section id="privacy" style="position: relative; z-index: 1;">
    <div class="container d-xl-flex justify-content-xl-center align-items-xl-center" style="height: 100px;">
        <h1 class="display-3" style="color: #ffffff;">{{ $company->name }}</h1>
    </div>
</section>
@endsection
@section('content')
<div class="container pt-5">
    <div class="row">
        <div class="col-lg-4 col-md-5 col-sm-12">
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
                        <a href="/lojas/produtos/{{ $company->id }}/todos/{{ Str::slug($company->name, '-') }}"
                            class="list-group-item list-group-item-action {{ $shop_product_category_id == 'todos'  ? 'active' : '' }}">Todos</a>
                        @foreach ($shop_product_categories as $shop_product_category)
                        <a href="/lojas/produtos/{{ $company->id }}/{{ $shop_product_category->id }}/{{ Str::slug($company->name, '-') }}"
                            class="list-group-item list-group-item-action {{ $shop_product_category_id == $shop_product_category->id ? 'active' : '' }}">{{
                            $shop_product_category->name }}</a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        <div class="col">
            <!-- ======= Portfolio Section ======= -->
            <section id="portfolio" class="portfolio">
                <div class="container">
                    @if (count($shop_product_sub_categories) > 0)
                    <div class="card mb-5">
                        <div class="card-body">
                            <ul id="portfolio-flters">
                                <li data-filter="*" class="filter-active">Todas</li>
                                @foreach ($shop_product_sub_categories as $shop_product_sub_category)
                                <li data-filter=".filter-{{ $shop_product_sub_category->id }}">{{
                                    $shop_product_sub_category->name }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    @endif

                    <div class="row portfolio-container">

                        @foreach ($products as $product)
                        <div
                            class="col-lg-4 col-md-6 portfolio-item filter-{{ count($product->shop_product_sub_categories) > 0 ? $product->shop_product_sub_categories[0]->id : '' }} wow fadeInUp">
                            <div class="portfolio-wrap">
                                <a href="/lojas/produto/{{ $product->id }}/{{ Str::slug($product->name, '-') }}">
                                    <div
                                        style="background-size: auto 100%; background-repeat: no-repeat; background-position: center center; background-image: url('{{ $product->photos ? $product->photos[0]->getUrl() : 'https://placehold.co/600x400?text=' . $product->name }}'); height:250px; width:100%;">
                                    </div>
                                    <div class="portfolio-info p-2">
                                        <p>{{ $product->name }}</p>
                                    </div>
                                </a>
                            </div>
                        </div>
                        @endforeach

                    </div>

                </div>
            </section><!-- End Portfolio Section -->
        </div>
    </div>
</div>

@endsection
@section('styles')
<style>
    #privacy {
        background: url("/theme/assets/img/hero-bg.jpg") bottom center;
        background-size: cover;
        margin-top: 70px;
    }

    #privacy::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5);
        z-index: -1;
    }
</style>
@endsection

@section('scripts')
<script>
    console.log({!! $products !!});
</script>
@endsection