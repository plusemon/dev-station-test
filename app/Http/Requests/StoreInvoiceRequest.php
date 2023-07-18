<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreInvoiceRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'invoiceDate' => ['required', 'date'],
            'dueDate' => ['required', 'date'],
            'customer_email' => ['required', 'email', 'max:255'],
            'items' => ['required', 'array'],
            'discount' => ['required', 'numeric'],
            'tax' => ['required', 'numeric'],
            'note' => ['required'],
        ];
    }
}
