<?php

namespace App\Http\Requests\Menu;

use App\Models\Branch;
use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'branch' => ['bail', 'sometimes', sprintf('exists:%s,id', Branch::class)], // TODO Firmanın branchleri için de aratılmalı
        ];
    }
}
