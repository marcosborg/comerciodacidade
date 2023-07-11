@extends('website.layouts.website')
@section('header')
<section id="privacy" style="position: relative; z-index: 1;">
    <div class="container d-xl-flex justify-content-xl-center align-items-xl-center" style="height: 100px;">
        <h1 class="display-3" style="color: #ffffff;">Teste</h1>
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
                        @foreach ($shop_categories as $shop_category)
                        <a href="/lojas/categoria/{{ $shop_category->id }}/{{ Str::slug($shop_category->name, '-') }}"
                            class="list-group-item list-group-item-action">{{ $shop_category->name
                            }}</a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        <div class="col">
            
        </div>
    </div>
</div>

@endsection
@section('styles')
<style>
    #privacy {
        background: url("") bottom center;
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
