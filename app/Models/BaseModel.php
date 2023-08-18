<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

abstract class BaseModel extends Model
{
    private array $globalHidden = ['deleted_at', 'deleted_by_id', 'password', 'remember_token'];

    public function __construct(array $attributes = [])
    {
        $this->hidden = array_merge($this->globalHidden, $this->hidden);
        parent::__construct($attributes);
    }
}
