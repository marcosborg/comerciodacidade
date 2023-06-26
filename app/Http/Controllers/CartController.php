<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\ShopProduct;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function addToCart(Request $request)
    {
        $product = ShopProduct::find($request->product_id);

        // Recupera o carrinho atual da sessão
        $cart = session()->get('cart', []);

        // Verifica se o produto já está no carrinho
        if (array_key_exists($product->id, $cart)) {
            // Atualiza a quantidade do produto no carrinho
            $cart[$product->id]['quantity'] += $request->qty;
        } else {
            // Adiciona um novo produto ao carrinho
            $cart[$product->id] = [
                'product' => $product,
                'quantity' => $request->qty,
            ];
        }

        // Atualiza o carrinho na sessão
        session()->put('cart', $cart);

        return session()->get('cart');
    }

    public function showCart()
    {
        return view('website.components.nav_cart');
    }

    public function deleteCart()
    {
        session()->forget('cart');
    }

}