<?php

namespace App\Http\Requests;

use App\Models\ShopProductVariation;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateShopProductVariationRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('shop_product_variation_edit');
    }

    public function rules()
    {
        return [
            'shop_product_id' => [
                'required',
                'integer',
            ],
            'name' => [
                'string',
                'required',
            ],
            'stock' => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
        ];
    }
}
