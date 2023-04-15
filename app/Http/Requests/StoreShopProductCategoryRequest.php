<?php

namespace App\Http\Requests;

use App\Models\ShopProductCategory;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreShopProductCategoryRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('shop_product_category_create');
    }

    public function rules()
    {
        return [
            'company_id' => [
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
