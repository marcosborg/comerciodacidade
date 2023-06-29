<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\ShopProduct;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function addToCart(Request $request)
    {
        $product = ShopProduct::find($request->product_id)->load('shop_product_categories.company');

        // Recupera o carrinho atual da sessão
        $cart = session()->get('cart', []);

        // Verifica se o produto já está no carrinho
        if (array_key_exists($product->id, $cart)) {
            // Atualiza a quantidade do produto no carrinho
            $cart[$product->id]['quantity'] += $request->qty;
        } else {
            // Verifica se o produto é de outra empresa
            if (count($cart) > 0) {
                foreach ($cart as $item) {
                    if ($product->shop_product_categories[0]->company_id != $item['company_id']) {
                        return false;
                    }
                }
            }
            // Adiciona um novo produto ao carrinho
            $cart[$product->id] = [
                'product' => $product,
                'quantity' => $request->qty,
                'company_id' => $product->shop_product_categories[0]->company_id
            ];
        }

        // Atualiza o carrinho na sessão
        session()->put('cart', $cart);

        return true;
    }

    public function showCart()
    {
        return view('website.components.nav_cart');
    }

    public function deleteCart()
    {
        session()->forget('cart');
    }

    public function changeQty($product_id, $qty)
    {

        // Verifique se o item existe na sessão
        if (session()->has('cart') && isset(session('cart')[$product_id])) {
            // Acesse a quantidade atual do item
            $quantidadeAtual = session('cart')[$product_id]['quantity'];

            // Aumente a quantidade em 1
            $quantidadeNova = $qty;

            // Atualize a quantidade na sessão
            session(['cart.' . $product_id . '.quantity' => $quantidadeNova]);
        }

    }

    public function deleteProduct($product_id)
    {
        $cart = session()->get('cart');

        // Procurar o item com o ID correspondente e removê-lo
        foreach ($cart as $index => $item) {
            if ($index === intval($product_id)) {
                unset($cart[$index]);
                break;
            }
        }

        // Atualizar o carrinho na sessão
        session()->put('cart', $cart);
    }

}