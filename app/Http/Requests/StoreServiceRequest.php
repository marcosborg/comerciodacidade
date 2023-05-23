<?php

namespace App\Http\Requests;

use App\Models\Service;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreServiceRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('service_create');
    }

    public function rules()
    {
        return [
            'shop_company_id' => [
                'required',
                'integer',
            ],
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
            'service_duration_id' => [
                'required',
                'integer',
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
            'price' => [
                'required',
            ],
            'tax_id' => [
                'required',
                'integer',
            ],
            'youtube' => [
                'string',
                'nullable',
            ],
            'attachment_name' => [
                'string',
                'nullable',
            ],
        ];
    }
}
