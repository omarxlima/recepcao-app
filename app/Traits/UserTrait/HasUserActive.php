<?php

namespace App\Traits\UserTrait;

use App\Models\User;
use Filament\Resources\Components\Tab;
use Illuminate\Database\Eloquent\Builder;

trait HasUserActive
{

    public function getTabs(): array
    {
        $model = static::getModel()::query();
        $total = $model->count();
        $ativos = $model->whereAtivo(true)->count();
        $inativos = $total - $ativos;
        return [
            'all' => Tab::make()
                ->label('Todos')
                ->icon('heroicon-o-bars-4')
                ->badge($total),
            'active' => Tab::make()
                ->label('Ativos')
                ->icon('heroicon-o-check-circle')
                ->badge($ativos)
                ->modifyQueryUsing(fn (Builder $query) => $query->whereActive(true)),
            'inactive' => Tab::make()
                ->label('Inativos')
                ->icon('heroicon-o-x-circle')
                ->badge($inativos)
                ->modifyQueryUsing(fn (Builder $query) => $query->whereActive(false)),
        ];
    }
}
