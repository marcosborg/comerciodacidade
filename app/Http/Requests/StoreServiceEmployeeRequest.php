<?php

namespace App\Http\Requests;

use App\Models\ServiceEmployee;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreServiceEmployeeRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('service_employee_create');
    }

    public function rules()
    {
        return [
            'name' => [
                'string',
                'required',
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
