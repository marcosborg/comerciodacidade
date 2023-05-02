<?php

namespace App\Http\Requests;

use App\Models\ShopProductSubCategory;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateShopProductSubCategoryRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('shop_product_sub_category_edit');
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
