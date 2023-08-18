<?php

namespace App\Models\Traits;

use App\Models\User;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

trait TrackUsersWithoutCreatingEvent
{
    public static function bootTrackUsersWithoutCreatingEvent(): void
    {
        static::updating(function ($model) {
            $model->updated_by_id = auth()->id();
        });

        static::deleted(function ($model) {
            $model->deleted_by_id = auth()->id();
            $model->update();
        });
    }

    public function updatedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'updated_by_id');
    }

    public function deletedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'deleted_by_id');
    }
}
