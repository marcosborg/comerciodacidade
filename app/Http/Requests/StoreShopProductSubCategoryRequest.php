<?php

namespace App\Http\Requests;

use App\Models\ShopProductSubCategory;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreShopProductSubCategoryRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('shop_product_sub_category_create');
    }

    public function rules()
    {
        return [
            'shop_product_category_id' => [
                'required',
                'integer',
            ],
            'name' => [
                'string',
                'required',
            ],
        ];
    }
}
