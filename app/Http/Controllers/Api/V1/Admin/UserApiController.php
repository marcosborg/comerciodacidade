<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Models\Address;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserApiController extends Controller
{

    public function user()
    {
        $user = Auth::guard('sanctum')->user()->load('address');

        return $user;
    }

    public function update(Request $request)
    {

        $request->validate([
            'name' => [
                'string',
                'required',
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
            'phone' => [
                'string',
                'nullable',
            ],
        ], [], [
                'name' => 'Nome',
                'address' => 'Endereço',
                'city' => 'Cidade',
                'zip' => 'Código postal',
                'phone' => 'Contacto'
            ]);

        $user = User::find($request->user_id);
        $user->name = $request->name;
        $user->save();

        $address = Address::where('user_id', $request->user_id)->first();
        if (!$address) {
            $address = new Address;
        }

        $address->user_id = $user->id;
        $address->address = $request->address;
        $address->city = $request->city;
        $address->country_id = $request->country_id;
        $address->phone = $request->phone;
        $address->zip = $request->zip;
        $address->vat = $request->vat;
        $address->save();

    }

}