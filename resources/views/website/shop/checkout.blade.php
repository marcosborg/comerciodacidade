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
<!-- Modal -->
<div class="modal fade" id="address_modal" tabindex="-1" aria-labelledby="addressModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="addressModalLabel">Endereço de entrega</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="/" method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <label>Endereço</label>
                        <input type="text" name="address" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Localidade</label>
                        <input type="text" name="city" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Código postal</label>
                        <input type="text" name="zip" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>País</label>
                        <select type="text" name="country_id" class="form-control" required>
                            @foreach ($countries as $country)
                            <option {{ $country->id == 170 ? 'selected' : '' }} value="{{ $country->id
                                }}">{{ $country->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Atualizar</button>
                </div>
            </form>
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
@parent
<script>
    console.log({!! collect(session()->get('cart')) !!});
    $(() => {
        getCheckout();
    });
    getCheckout = () => {
        $.get('/lojas/inner-checkout').then((resp) => {
            $('#inner_checkout').html(resp);
            checkSame();
        });
    }
    updateQty = (product_id, value) => {
        $.get('/cart/change-qty/' + product_id + '/' + value).then((resp) => {
            getCheckout();
        });
    }
    deleteProduct = (product_id) => {
        $.get('/cart/delete-product/' + product_id).then((resp) => {
            console.log(resp);
            getCheckout();
            showCart();
        });
    }
    checkSame = () => {
        if($('#billing_same').prop('checked') == true) {
            $('#billing_collapse').collapse('show');
        } else {
            $('#billing_collapse').collapse('hide');
        }
    }
    changeSame = (address_id) => {
        console.log(address_id);
        $.get('/cart/change-same/' + address_id).then(() => {
            getCheckout();
        });
    }
</script>
@endsection