@extends('website.layouts.website')
@section('description')
{{ $product->shop_product_categories[0]->company->name }} | {{ $product->name }}
@endsection
@section('header')
<section id="privacy" style="position: relative; z-index: 1;">
    <div class="container d-xl-flex justify-content-xl-center align-items-xl-center" style="height: 100px;">
        <h1 class="display-3" style="color: #ffffff;">{{ $product->name }}</h1>
    </div>
</section>
@endsection
@section('content')
<div class="container p-5">
    <div class="row">
        <div class="col-md-7">
            <!-- Slider main container -->
            <div style="--swiper-navigation-color: #fff; --swiper-pagination-color: #fff" class="swiper mySwiper2" zoom="true">
                <div class="swiper-wrapper">
                    @foreach ($product->photos as $photo)
                    <div class="swiper-slide">
                        <div class="swiper-zoom-container">
                            <img src="{{ $photo->original_url }}" />
                        </div>
                    </div>
                    @endforeach
                </div>
                <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div>
            </div>
            <div thumbsSlider="" class="swiper mySwiper">
                <div class="swiper-wrapper">
                    @foreach ($product->photos as $photo)
                    <div class="swiper-slide">
                        <img src="{{ $photo->original_url }}" />
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="col-md-5">
            <h2>{{ $product->name }}</h2>
            <strong>{{ $product->shop_product_categories[0]->company->name }}</strong>
            <h1 class="mt-4">€ {{ $product->price }}</h1>
            <label class="mt-4 mb-2">Quantidade</label>
            <div class="input-group mb-3 w-50">
                <div class="input-group-append">
                    <button class="btn btn-outline-secondary" type="button" id="decreaseBtn">-</button>
                </div>
                <input type="number" class="form-control text-center" value="1" min="1" max="10" disabled>
                <div class="input-group-append">
                    <button class="btn btn-outline-secondary" type="button" id="increaseBtn">+</button>
                </div>
            </div>
            <button class="btn btn-orange btn-lg mt-4">Comprar</button>
        </div>
    </div>
</div>
@endsection
@section('styles')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css" />
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

    .btn-orange {
        font-family: "Poppins", sans-serif;
        font-weight: 400;
        font-size: 13px;
        letter-spacing: 2px;
        display: inline-block;
        padding: 12px 28px;
        border-radius: 4px;
        transition: ease-in-out 0.3s;
        color: #fff;
        background: #e2742b;
        text-transform: uppercase;
    }

    .btn-orange:hover {
        background: #af5a21;
    }

    .swiper {
        width: 100%;
        height: 100%;
    }

    .swiper-slide {
        text-align: center;
        font-size: 18px;
        background: #fff;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .swiper-slide img {
        display: block;
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .swiper {
        width: 100%;
        height: 300px;
        margin-left: auto;
        margin-right: auto;
    }

    .swiper-slide {
        background-size: cover;
        background-position: center;
    }

    .mySwiper2 {
        height: 80%;
        width: 100%;
    }

    .mySwiper {
        height: 20%;
        box-sizing: border-box;
        padding: 10px 0;
    }

    .mySwiper .swiper-slide {
        width: 25%;
        height: 100%;
        opacity: 0.4;
    }

    .mySwiper .swiper-slide-thumb-active {
        opacity: 1;
    }

    .swiper-slide img {
        display: block;
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
</style>
@endsection
@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script>
<script>
    console.log({!! $product !!});
    document.getElementById("decreaseBtn").addEventListener("click", function() {
      var input = document.querySelector(".form-control");
      var value = parseInt(input.value);

      if (value > 1) {
        input.value = value - 1;
      }
    });

    document.getElementById("increaseBtn").addEventListener("click", function() {
      var input = document.querySelector(".form-control");
      var value = parseInt(input.value);

      if (value < 10) {
        input.value = value + 1;
      }
    });

    var swiper = new Swiper(".mySwiper", {
      loop: true,
      spaceBetween: 10,
      slidesPerView: 4,
      freeMode: true,
      watchSlidesProgress: true,
    });
    var swiper2 = new Swiper(".mySwiper2", {
      zoom: true,
      loop: true,
      spaceBetween: 10,
      navigation: {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev",
      },
      thumbs: {
        swiper: swiper,
      },
    });
</script>
@endsection