<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Builder;

trait CanFilterByUser
{
    public function scopeByCurrentUser(Builder $builder)
    {
        return $builder->where('user_id', auth()->user()->id);
    }
}
