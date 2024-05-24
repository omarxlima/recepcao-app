<?php

namespace App\Traits\UserTrait;

use App\Models\User;
use Filament\Resources\Components\Tab;
use Illuminate\Database\Eloquent\Builder;

trait Multilocatario
{
    protected static function bootMultilocatario(): void
    {
        if (auth()->check()) {
            static::creating(function ($model) {
                // $model->user_id = auth()->id();
                $model->grupo_id = auth()->user()->grupo_id;
            });
        }
 
        static::addGlobalScope('created_by_grupo_id', function (Builder $builder) {
            $builder->where('grupo_id', auth()->user()->grupo_id);
        });
    }
}
