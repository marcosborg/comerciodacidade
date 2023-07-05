@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.purchase.title_singular') }}
    </div>

    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <strong>Método de pagamento: </strong>{{ $purchase->method }}<br>
                        <strong>Id do pagamento: </strong>{{ $purchase->id_payment }}<br>
                        <strong>Estado do pagamento: </strong>{{ $purchase->payed ? 'pago' : 'Aguarda pagamento' }}<br>
                        <strong>Total: </strong>€{{ $purchase->total }}
                    </div>
                </div>
                @foreach (json_decode($purchase->cart) as $item)
                <div class="card">
                    <div class="card-body">
                        <strong>Produto: </strong>{{ $item->product->name }}<br>
                        <strong>Preço: </strong>€{{ $item->product->price }}<br>
                        <strong>Referência: </strong>{{ $item->product->reference }}<br>
                        <strong>IVA: </strong>{{ $item->product->tax->name }} ({{ $item->product->tax->tax }}%)<br>
                        <strong>Quantidade: </strong>{{ $item->quantity }}
                    </div>
                </div>
                @endforeach
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <strong>Cliente: </strong>{{ $purchase->user->name }}<br>
                        <strong>Email: </strong>{{ $purchase->user->email }}<br>
                        <strong>Contacto: </strong>{{ $purchase->user->address->phone }}<br>
                        <strong>Endereço de entrega</strong><br>
                        {{ $purchase->user->address->address }}, {{ $purchase->user->address->zip }}, {{
                        $purchase->user->address->city }}, {{ $purchase->user->address->country->name }}<br>
                        <strong>Endereço de faturação: </strong><br>
                        @if ($purchase->user->address->billing_address)
                        {{ $purchase->user->address->billing_address }}, {{ $purchase->user->address->billing_zip
                        }}, {{ $purchase->user->address->billing_city }}, {{
                        $purchase->user->address->billing_country ? $purchase->user->address->billing_country->name
                        : '' }}
                        @else
                        {{ $purchase->user->address->address }}, {{ $purchase->user->address->zip }}, {{
                        $purchase->user->address->city }}, {{ $purchase->user->address->country->name }}
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



@endsection
@section('scripts')
@parent
<script>
    console.log({
        purchase: {!! $purchase !!},
        address: {!! $purchase->address !!},
        cart: {!! $purchase->cart !!}
    });
</script>
@endsection