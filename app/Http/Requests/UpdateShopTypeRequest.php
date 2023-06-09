<?php

namespace App\Http\Requests;

use App\Models\ShopType;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateShopTypeRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('shop_type_edit');
    }

    public function rules()
    {
        return [
            'name' => [
                'string',
                'required',
            ],
            'icon' => [
                'string',
                'nullable',
            ],
        ];
    }
}
