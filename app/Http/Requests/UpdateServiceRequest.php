<?php

namespace App\Http\Requests;

use App\Models\Service;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateServiceRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('service_edit');
    }

    public function rules()
    {
        return [
            'name' => [
                'string',
                'required',
            ],
            'shop_company_id' => [
                'required',
                'integer',
            ],
            'price' => [
                'required',
            ],
            'service_duration_id' => [
                'required',
                'integer',
            ],
            'photos' => [
                'array',
            ],
        ];
    }
}
