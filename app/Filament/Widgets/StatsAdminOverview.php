<?php

namespace App\Filament\Widgets;

use App\Models\Funcionario;
use App\Models\User;
use App\Models\Visitor;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsAdminOverview extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            
            Stat::make('Usuários', User::query()->count())
                ->description('Todos usuários')
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->color('success'),
            Stat::make('Funcionários', Funcionario::query()->count())
                ->description('Todos funcionários')
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->color('success'),
            Stat::make('Visitantes', Visitor::query()->count())
                ->description('Todos visitantes')
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->color('success'),


            // Stat::make('Bounce rate', '21%')
            //     ->description('7% increase')
            //     ->descriptionIcon('heroicon-m-arrow-trending-down')
            //     ->color('danger'),
            // Stat::make('Average time on page', '3:12')
            //     ->description('3% increase')
            //     ->descriptionIcon('heroicon-m-arrow-trending-up')
            //     ->color('success'),
        ];
    }
}
