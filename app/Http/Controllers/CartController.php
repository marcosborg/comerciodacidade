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

    public function increseQty($product_id)
    {

    }

    public function decreseQty($product_id)
    {

    }

}