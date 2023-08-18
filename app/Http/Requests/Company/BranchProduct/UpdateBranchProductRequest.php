<?php

namespace App\Http\Requests\Company\BranchProduct;

use App\Models\Branch;
use App\Models\Enums\Currency;
use App\Models\Product;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateBranchProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'branch_id' => ['bail', 'required', sprintf('exists:%s,id', Branch::class)],
            'product_id' => ['bail', 'required', sprintf('exists:%s,id', Product::class)],
            'price' => ['bail', 'required', 'numeric'],
            'currency' => ['bail', 'required', Rule::in(Currency::getValues())],
            'is_active' => ['bail', 'nullable', 'boolean'],
        ];
    }
}
