<?php

namespace App\Http\Requests;

use App\Models\IfthenPay;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreIfthenPayRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('ifthen_pay_create');
    }

    public function rules()
    {
        return [
            'company_id' => [
                'required',
                'integer',
            ],
            'mb_key' => [
                'string',
                'nullable',
            ],
            'mbway_key' => [
                'string',
                'nullable',
            ],
            'antiphishing' => [
                'string',
                'required',
            ],
        ];
    }
}
