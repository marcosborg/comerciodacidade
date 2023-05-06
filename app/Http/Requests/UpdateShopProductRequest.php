<?php

namespace App\Http\Requests;

use App\Models\ShopProduct;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateShopProductRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('shop_product_edit');
    }

    public function rules()
    {
        return [
            'name' => [
                'string',
                'required',
            ],
            'reference' => [
                'string',
                'nullable',
            ],
            'photos' => [
                'array',
            ],
            'shop_product_categories.*' => [
                'integer',
            ],
            'shop_product_categories' => [
                'array',
            ],
            'shop_product_sub_categories.*' => [
                'integer',
            ],
            'shop_product_sub_categories' => [
                'array',
            ],
            'tax_id' => [
                'required',
                'integer',
            ],
        ];
    }
}