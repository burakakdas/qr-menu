<?php

namespace App\Models;

use App\Filters\Utils\FetchType\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Media extends Model
{
    protected $table = 'media';

    protected $fillable = [
        'model',
        'is_cover',
        'media_type',
        'source',
        'order'
    ];

    public function mediable(): MorphTo
    {
        return $this->morphTo();
    }
}
