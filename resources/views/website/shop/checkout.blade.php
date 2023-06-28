@extends('website.layouts.website')
@section('description')
Checkout
@endsection
@section('header')
<section id="privacy" style="position: relative; z-index: 1;">
    <div class="container d-xl-flex justify-content-xl-center align-items-xl-center" style="height: 100px;">
        <h1 class="display-3" style="color: #ffffff;">Checkout</h1>
    </div>
</section>
@endsection
@section('content')
<div class="container p-5">
    <div class="container" id="inner_checkout"></div>
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
@parent
<script>
    console.log({!! collect(session()->get('cart')) !!});
    $(() => {
        getCheckout();
    });
    getCheckout = () => {
        $.get('/lojas/inner-checkout').then((resp) => {
            $('#inner_checkout').html(resp);
        });
    }
    updateQty = (product_id, value) => {
        $.get('/cart/change-qty/' + product_id + '/' + value).then((resp) => {
            getCheckout();
        });
    }
</script>
@endsection