<div class="row">
    @if (count($products) > 0)
    <div class="col-12 col-sm-12 col-md-12 col-lg-6">
        @if (!auth()->check())
        <div class="card shadow mb-4">
            <div class="card-body">
                <div class="row">
                    <div class="col-12 col-sm-6"><button class="btn btn-outline-orange d-block w-100" type="button"
                            data-bs-toggle="modal" data-bs-target="#login_modal">Login</button></div>
                    <div class="col"><button class="btn btn-orange d-block w-100" type="button" data-bs-toggle="modal"
                            data-bs-target="#create_modal">Criar conta</button>
                    </div>
                </div>
            </div>
        </div>
        @endif
        @foreach ($products as $product)
        <div class="card mb-3">
            <div class="card-body shadow">
                <div class="row">
                    <div class="col-4 text-center"><img class="img-fluid shadow-none p-2"
                            src="{{ $product['product']['photos'][0]['preview_url'] }}" />
                    </div>
                    <div class="col">
                        <p class="mt-2"><strong> {{ $product['product']['name'] }}</strong></p>
                        <p class="mt-2"><strong>€{{ $product['product']['price'] }}</strong></p>
                        <p class="text-black-50"></p>
                        <div class="input-group mb-3">
                            <input class="form-control" type="number" placeholder="Qty" min="1"
                                value="{{ $product['quantity'] }}" name="qty"
                                onchange="updateQty({{ $product['product']['id'] }}, this.value)" />
                            <button class="btn btn-danger btn-sm" type="button"
                                onclick="deleteProduct({{ $product['product']['id'] }})"><i
                                    class="bi bi-trash"></i></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    <div class="col-12 col-sm-12 col-md-12 col-lg-6">
        <div class="card shadow">
            <div class="card-body">
                <div class="row">
                    <div class="col">
                        <p>Preço</p>
                    </div>
                    <div class="col">
                        <p class="text-end">€ {{ $total }}</p>
                    </div>
                </div>
                <hr style="color: rgb(0,0,0);" />
                <div class="row">
                    <div class="col">
                        <p>Transporte</p>
                    </div>
                    <div class="col">
                        <p class="text-end"><i class="fa fa-euro"></i>  Gratuito</p>
                    </div>
                </div>
                <hr style="color: rgb(0,0,0);" />
                <div class="row">
                    <div class="col">
                        <p style="font-size: 18px;"><strong>Total</strong></p>
                    </div>
                    <div class="col">
                        <p class="text-end" style="font-size: 18px;"><i class="fa fa-euro"></i>€ {{ $total }}</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="card shadow pt-2 mt-4">
            <div class="card-header">
                Endereços
            </div>
            <div class="card-body">
                <strong>Endereço de entrega</strong>
                <p>{{ $address->address }}<br>{{ $address->zip }} {{ $address->city }}<br>{{ $address->country->name }}
                </p>
                <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" role="switch" id="billing_same" {{
                        $address->billing_same ? 'checked' : '' }}>
                    <label class="form-check-label" for="billing_same">Endereço de faturação diferente do
                        endereço de entrega</label>
                </div>
                <hr>
                <div class="collapse" id="billing_collapse">
                    <strong>Endereço de faturação</strong>
                    <p>{!! $address->billing_address ? $address->billing_address : '<span
                            class="placeholder w-50"></span>'
                        !!}
                        <br>{!! $address->billing_zip ? $address->billing_zip : '<span class="placeholder w-25"></span>'
                        !!}
                        {{ $address->billing_city }}
                        <br>{!!
                        $address->billing_country ? $address->billing_country->name : '<span
                            class="placeholder w-25"></span>' !!}
                    </p>
                </div>
                <div class="row">
                    <div class="col"><button class="btn btn-outline-dark d-block w-100" type="button">Editar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @else
</div>
<div class="alert alert-primary" role="alert">
    Não existem produtos ou serviços no seu carrinho!
</div>
@endif
<script>
    console.log({!! $address !!})
</script>