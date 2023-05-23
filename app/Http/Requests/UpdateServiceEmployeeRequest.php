<?php

namespace App\Http\Requests;

use App\Models\ServiceEmployee;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateServiceEmployeeRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('service_employee_edit');
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
            'services.*' => [
                'integer',
            ],
            'services' => [
                'array',
            ],
        ];
    }
}
