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
            <div style="--swiper-navigation-color: #fff; --swiper-pagination-color: #fff" class="swiper mySwiper2"
                zoom="true">
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
            <form action="/cart/add-to-cart" method="post">
                <h2>{{ $product->name }}</h2>
                <small><strong>Referencia: </strong>{{ $product->reference }}</small><br>
                <strong>{{ $product->shop_product_categories[0]->company->name }}</strong>
                <h1 class="mt-4">€ {{ $product->price }}</h1>
                <label class="mt-4 mb-2">Quantidade</label>
                <div class="input-group mb-3 w-50">
                    <div class="input-group-append">
                        <button class="btn btn-outline-secondary" type="button" id="decreaseBtn">-</button>
                    </div>
                    <input type="number" class="form-control text-center" value="1" min="1" max="10" disabled>
                    <input type="hidden" name="qty" value="1">
                    <div class="input-group-append">
                        <button class="btn btn-outline-secondary" type="button" id="increaseBtn">+</button>
                    </div>
                </div>
                @csrf
                <input type="hidden" name="product_id" value="{{ $product->id }}">
                <button type="submit" class="btn btn-orange btn-lg mt-4">Comprar</button>
            </form>
        </div>
    </div>
    <div class="row">
        <div class="col-md-7">
            <div class="card">
                <div class="card-header">
                    Descrição
                </div>
                <div class="card-body">
                    {!! $product->description !!}
                </div>
            </div>
        </div>
        <div class="col-md-5">
            <div class="card">
                <div class="card-header">
                    <ul class="nav nav nav-pills nav-fill" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#features"
                                type="button" role="tab">Caracteristicas</button>
                        </li>
                        @if ($product->youtube)
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" data-bs-toggle="tab" data-bs-target="#video" type="button"
                                role="tab">Vídeo</button>
                        </li>
                        @endif
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" data-bs-toggle="tab" data-bs-target="#others" type="button"
                                role="tab">Outros</button>
                        </li>
                    </ul>
                </div>
                <div class="card-body">
                    <div class="tab-content">
                        <div class="tab-pane fade show active" id="features" role="tabpanel">
                            <ul class="list-group">
                                @foreach ($product->shop_product_features as $feature)
                                <li class="list-group-item">{{ $feature->name }}</li>
                                @endforeach
                            </ul>
                        </div>
                        @if ($product->youtube)
                        <div class="tab-pane fade" id="video" role="tabpanel">
                            <div class="ratio ratio-16x9">
                                <iframe src="https://www.youtube.com/embed/{{ $product->youtube }}?controls=0"
                                    frameborder="0"
                                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                                    allowfullscreen></iframe>
                            </div>

                        </div>
                        @endif
                        <div class="tab-pane fade" id="others" role="tabpanel">Outros</div>
                    </div>
                </div>
            </div>
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

    .nav-pills .nav-link.active,
    .nav-pills .show>.nav-link {
        color: var(--bs-nav-pills-link-active-color);
        background-color: #e2742b;
    }

    .nav-fill .nav-item .nav-link,
    .nav-justified .nav-item .nav-link {
        width: 100%;
        padding: 0px;
    }
</style>
@endsection
@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script>
<script>
    document.getElementById("decreaseBtn").addEventListener("click", function() {
      var input = document.querySelector(".form-control");
      var value = parseInt(input.value);
      if (value > 1) {
        value = value - 1
        input.value = value;
      }
      $('input[name=qty]').val(value);
    });

    document.getElementById("increaseBtn").addEventListener("click", function() {
      var input = document.querySelector(".form-control");
      var value = parseInt(input.value);
      if (value < 10) {
        value = value + 1;
        input.value = value;
      }
      $('input[name=qty]').val(value);
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
    $(() => {
        $('form').ajaxForm({
            beforeSubmit: () => {
                $.LoadingOverlay('show');
            },
            success: () => {
                $.LoadingOverlay('hide');
                showCart();
                Swal.fire({
                    title: 'Quer ir para checkout?',
                    showCancelButton: true,
                    cancelButtonText: 'Quero continuar na loja',
                    confirmButtonText: 'Sim!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href="/lojas/checkout";
                    }
                });
            }
        });
    });
</script>
@endsection