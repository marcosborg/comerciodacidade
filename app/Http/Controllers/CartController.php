<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Address;
use App\Models\Purchase;
use App\Models\ShopProduct;
use Illuminate\Http\Request;

class CartController extends Controller
{

    private $MbWayKey;

    public function __construct()
    {
        $this->MbWayKey = 'SXK-861353';
    }

    public function addToCart(Request $request)
    {
        $product = ShopProduct::find($request->product_id)->load('shop_product_categories.company', 'tax');

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

    public function changeSame($address_id)
    {
        $address = Address::find($address_id);
        if ($address->billing_same == true) {
            $address->billing_same = false;
        } else {
            $address->billing_same = true;
        }
        $address->save();
    }

    public function createAddress(Request $request)
    {
        $request->validate([
            'user_id' => [
                'required',
                'integer',
            ],
            'address' => [
                'string',
                'required',
            ],
            'city' => [
                'string',
                'required',
            ],
            'zip' => [
                'string',
                'required',
            ],
            'country_id' => [
                'required',
                'integer',
            ],
            'phone' => [
                'string',
                'nullable',
            ],
        ]);

        $address = new Address;
        $address->user_id = $request->user_id;
        $address->address = $request->address;
        $address->zip = $request->zip;
        $address->city = $request->city;
        $address->country_id = $request->country_id;
        $address->phone = $request->phone;
        $address->save();
    }

    public function updateAddress(Request $request)
    {
        $request->validate([
            'address' => [
                'string',
                'required',
            ],
            'city' => [
                'string',
                'required',
            ],
            'zip' => [
                'string',
                'required',
            ],
            'country_id' => [
                'required',
                'integer',
            ],
            'phone' => [
                'string',
                'nullable',
            ],
        ]);

        $address = Address::find($request->address_id);
        $address->address = $request->address;
        $address->zip = $request->zip;
        $address->city = $request->city;
        $address->country_id = $request->country_id;
        $address->phone = $request->phone;
        $address->save();
    }

    public function updateBillingAddress(Request $request)
    {
        $request->validate([
            'billing_country_id' => [
                'required',
                'integer',
            ],
            'billing_address' => [
                'string',
                'nullable',
            ],
            'billing_city' => [
                'string',
                'nullable',
            ],
            'billing_zip' => [
                'string',
                'nullable',
            ],
        ]);

        $address = Address::find($request->address_id);
        $address->billing_address = $request->billing_address;
        $address->billing_zip = $request->billing_zip;
        $address->billing_city = $request->billing_city;
        $address->billing_country_id = $request->billing_country_id;
        $address->save();

    }

    public function generatePayments(Request $request)
    {

        $cart = collect();
        $total = 0;

        foreach ($request->cart as $item) {
            $cart->add($item);
            $total = $total + ($item['product']['price'] * $item['quantity']);
        }

        $company_id = $cart[0]['product']['shop_product_categories'][0]['company_id'];

        $lastPurchase = Purchase::whereHas('product.shop_product_categories', function ($shop_product_categories) use ($company_id) {
            $shop_product_categories->where('company_id', $company_id);
        })->latest()->first()->load('product.shop_product_categories');

        $purchase = new Purchase;
        $purchase->type = 'product';
        $purchase->relationship = $cart[0]['product']['id'];
        $purchase->name = $cart[0]['product']['name'];
        $purchase->price = $cart[0]['product']['price'];
        $purchase->vat = $cart[0]['product']['tax']['tax'];
        $purchase->status = 0;
        $purchase->user_id = $request->user['id'];
        $purchase->total = $total;
        $purchase->qty = $cart[0]['quantity'];
        $purchase->cart = json_encode($cart);
        $purchase->address = json_encode($request->address);
        $purchase->method = $request->type;
        $purchase->payed = 0;
        $purchase->internal = $lastPurchase->internal + 1;
        $purchase->save();

        $curl = curl_init();

        curl_setopt_array(
            $curl,
            array(
                CURLOPT_URL => 'mbway.ifthenpay.com/ifthenpaymbw.asmx/SetPedidoJSON?MbWayKey=' . $this->MbWayKey . '&canal=03&referencia=' . $purchase->id . '&valor=' . $total . '&nrtlm=' . $request->celphone . '&email=&descricao=',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'GET',
            )
        );

        $response = curl_exec($curl);

        curl_close($curl);
        return $response;
    }

    public function checkMbwayPayment($id_payment)
    {

        $curl = curl_init();

        curl_setopt_array(
            $curl,
            array(
                CURLOPT_URL => 'mbway.ifthenpay.com/ifthenpaymbw.asmx/EstadoPedidosJSON?MbWayKey=' . $this->MbWayKey . '&canal=3&idspagamento=' . $id_payment,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'GET',
            )
        );

        $response = curl_exec($curl);

        curl_close($curl);

        // Converte a resposta JSON em uma array
        $data = json_decode($response, true);

        // Verifica se houve um erro ao decodificar o JSON
        if ($data === null) {
            // Retorna uma resposta de erro como JSON
            $error = array(
                'error' => 'Ocorreu um erro ao decodificar o JSON da resposta'
            );
            return json_encode($error);
        }

        // Retorna a resposta como uma array
        return $data['EstadoPedidos'][0]['MsgDescricao'];

    }

}