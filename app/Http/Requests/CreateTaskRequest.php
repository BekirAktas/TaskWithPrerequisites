<?php

namespace App\Http\Requests;

use Config;
use Illuminate\Foundation\Http\FormRequest;
use Response;


class CreateTaskRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [ 
            'title' => 'required',
            'type' => 'required|in:common_ops,invoice_ops,custom_ops',
            'amount' => 'required_if:type,invoice_ops',
            'amount.currency' => 'required|in:₺,€,$,£',
            'amount.quantity' => 'required',
            'country' => 'required_if:type,custom_ops',
        ];
    }
}
