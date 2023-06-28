<div class="row">
    <div class="col-12 col-sm-12 col-md-12 col-lg-6">
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
                                value="{{ $product['quantity'] }}" name="qty" onchange="updateQty({{ $product['product']['id'] }}, this.value)" />
                            <button class="btn btn-danger btn-sm" type="button"><i class="bi bi-trash"></i></button>
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
                <hr style="color: rgb(0,0,0);" />
                <div class="row">
                    <div class="col-12 col-sm-6"><button class="btn btn-outline-dark d-block w-100" type="submit">Cash
                            on delivery</button></div>
                    <div class="col"><button class="btn btn-primary d-block w-100" type="button">Pay
                            now</button></div>
                </div>
            </div>
        </div>
        <div class="card shadow pt-2">
            <div class="card-body">
                <form>
                    <div class="form-group mb-3">
                        <div class="form-check"><input id="formCheck-1" class="form-check-input" type="radio"
                                name="size" value="s" checked /><label class="form-check-label"
                                for="formCheck-1">Address 1 Pamplona</label></div>
                    </div>
                    <div class="form-group mb-3">
                        <div class="form-check"><input id="formCheck-3" class="form-check-input" type="radio"
                                name="size" value="m" /><label class="form-check-label" for="formCheck-3">Address 2
                                Tarazona</label></div>
                    </div>
                    <div class="form-group mb-3">
                        <div class="form-check"><input id="formCheck-2" class="form-check-input" type="radio"
                                name="size" value="l" /><label class="form-check-label" for="formCheck-2">Address 3
                                Zaragoza</label></div>
                    </div>
                </form>
                <div class="row">
                    <div class="col"><button class="btn btn-outline-dark d-block w-100" type="button">Add New
                            Address</button></div>
                </div>
            </div>
        </div>
    </div>
</div>