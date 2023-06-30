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
<div class="modal fade" id="create_address_modal" tabindex="-1" aria-labelledby="create_address_label"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="create_address_label">Endereço</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="/cart/create-address" method="post">
                @csrf
                <input type="hidden" name="user_id" value="{{ $user ? $user->id : '' }}">
                <div class="modal-body">
                    <div class="form-group">
                        <label>Endereço</label>
                        <input type="text" name="address" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Código Postal</label>
                        <input type="text" name="zip" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Localidade</label>
                        <input type="text" name="city" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>País</label>
                        <select name="country_id" class="form-control" required>
                            @foreach ($countries as $country)
                            <option {{ $country->id == 170 ? 'selected' : '' }} value="{{ $country->id }}">{{
                                $country->name
                                }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Telefone</label>
                        <input type="text" name="phone" class="form-control">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Gravar</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="edit_address_modal" tabindex="-1" aria-labelledby="edit_address_label" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="edit_address_label">Atualizar endereço</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="/cart/update-address" method="post">
                @csrf
                <input type="hidden" name="address_id" value="{{ $address ? $address->id : '' }}">
                <div class="modal-body">
                    <div class="form-group">
                        <label>Endereço</label>
                        <input type="text" name="address" class="form-control" required value="{{ $address->address }}">
                    </div>
                    <div class="form-group">
                        <label>Código Postal</label>
                        <input type="text" name="zip" class="form-control" required value="{{ $address->zip }}">
                    </div>
                    <div class="form-group">
                        <label>Localidade</label>
                        <input type="text" name="city" class="form-control" required value="{{ $address->city }}">
                    </div>
                    <div class="form-group">
                        <label>País</label>
                        <select name="country_id" class="form-control" required>
                            @foreach ($countries as $country)
                            <option {{ $country->id == $address->country_id ? 'selected' : '' }} value="{{ $country->id
                                }}">{{
                                $country->name
                                }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Telefone</label>
                        <input type="text" name="phone" class="form-control" value="{{ $address->phone }}">
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
<!-- Modal -->
<div class="modal fade" id="edit_billing_address_modal" tabindex="-1" aria-labelledby="edit_billing_address_label"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="edit_billing_address_label">Atualizar endereço de faturação</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="/cart/update-billing-address" method="post">
                @csrf
                <input type="hidden" name="address_id" value="{{ $address ? $address->id : '' }}">
                <div class="modal-body">
                    <div class="form-group">
                        <label>Endereço</label>
                        <input type="text" name="billing_address" class="form-control" required
                            value="{{ $address->billing_address }}">
                    </div>
                    <div class="form-group">
                        <label>Código Postal</label>
                        <input type="text" name="billing_zip" class="form-control" required
                            value="{{ $address->billing_zip }}">
                    </div>
                    <div class="form-group">
                        <label>Localidade</label>
                        <input type="text" name="billing_city" class="form-control" required
                            value="{{ $address->billing_city }}">
                    </div>
                    <div class="form-group">
                        <label>País</label>
                        <select name="billing_country_id" class="form-control" required>
                            @foreach ($countries as $country)
                            @if ($address->billing_country_id)
                            <option {{ $country->id == $address->billing_country_id ? 'selected' : '' }} value="{{
                                $country->id }}">{{
                                $country->name
                                }}</option>
                            @else
                            <option {{ $country->id == 170 ? 'selected' : '' }} value="{{
                                $country->id }}">{{
                                $country->name
                                }}</option>
                            @endif
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
        $('#create_address_modal form').ajaxForm({
            beforeSubmit: () => {
                $.LoadingOverlay('show');
            },
            success: (resp) => {
                $.LoadingOverlay('hide');
                Swal.fire({
                    icon: 'success',
                    title: 'Pode continuar',
                }).then(() => {
                    $('#create_address_modal').modal('hide');
                    setTimeout(() => {
                        location.reload(); 
                    }, 500);
                });
            },
            error: (error) => {
                $.LoadingOverlay('hide');
                let html = '';
                $.each(JSON.parse(error.responseText).errors, (i, v) => {
                    $.each(v, (index, value) => {
                    html += value + '<br />';
                    });
                });
                Swal.fire({
                    icon: 'error',
                    title: 'Erro de validação',
                    html: html,
                });
            }
        });
        $('#edit_address_modal form').ajaxForm({
            beforeSubmit: () => {
                $.LoadingOverlay('show');
            },
            success: (resp) => {
                $.LoadingOverlay('hide');
                Swal.fire({
                    icon: 'success',
                    title: 'Pode continuar',
                }).then(() => {
                    $('#edit_address_modal').modal('hide');
                    setTimeout(() => {
                        location.reload(); 
                    }, 500);
                });
            },
            error: (error) => {
                $.LoadingOverlay('hide');
                let html = '';
                $.each(JSON.parse(error.responseText).errors, (i, v) => {
                    $.each(v, (index, value) => {
                    html += value + '<br />';
                    });
                });
                Swal.fire({
                    icon: 'error',
                    title: 'Erro de validação',
                    html: html,
                });
            }
        });
        $('#edit_billing_address_modal form').ajaxForm({
            beforeSubmit: () => {
                $.LoadingOverlay('show');
            },
            success: (resp) => {
                $.LoadingOverlay('hide');
                Swal.fire({
                    icon: 'success',
                    title: 'Pode continuar',
                }).then(() => {
                    $('#edit_address_modal').modal('hide');
                    setTimeout(() => {
                        location.reload(); 
                    }, 500);
                });
            },
            error: (error) => {
                $.LoadingOverlay('hide');
                let html = '';
                $.each(JSON.parse(error.responseText).errors, (i, v) => {
                    $.each(v, (index, value) => {
                    html += value + '<br />';
                    });
                });
                Swal.fire({
                    icon: 'error',
                    title: 'Erro de validação',
                    html: html,
                });
            }
        });
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
    createAddress = () => {
        $('#create_address_modal').modal('show');
    }
    editAddress = () => {
        $('#edit_address_modal').modal('show');
    }
    editBillingAddress = () => {
        $('#edit_billing_address_modal').modal('show');
    }
</script>
@endsection