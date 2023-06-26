<div class="d-flex justify-content-between">
    <strong>CARRINHO</strong>
    <button onclick="deleteCart()" class="btn btn-sm" style="color: #e2742b; padding: 0;"><i class="bi bi-trash"></i></button>
</div>
<hr>
@if (session()->get('cart'))
@foreach (session()->get('cart') as $item)
<div class="cart-item">
    {{ $item['product']['name'] }}<br>€{{ $item['product']['price'] }} X {{ $item['quantity'] }}
</div>
@endforeach
<div class="d-grid gap-2">
    <button onclick="goCart()" class="btn btn-sm btn-orange ">Checkout</button>
</div>
@else
<p style="font-size: 13px;">Adicione o primeiro produto</p>
@endif