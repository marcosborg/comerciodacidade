<?php

namespace App\Http\Requests;

use App\Models\ShopCompany;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateShopCompanyRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('shop_company_edit');
    }

    public function rules()
    {
        return [
            'company_id' => [
                'required',
                'integer',
            ],
            'shop_location_id' => [
                'required',
                'integer',
            ],
            'shop_categories.*' => [
                'integer',
            ],
            'shop_categories' => [
                'array',
            ],
            'photos' => [
                'array',
            ],
        ];
    }
}