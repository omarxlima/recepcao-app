<?php

namespace App\Filament\Resources\FuncionarioResource\Pages;

use App\Filament\Resources\FuncionarioResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageFuncionarios extends ManageRecords
{
    protected static string $resource = FuncionarioResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
            ->mutateFormDataUsing(function (array $data): array {
                $data['user_id'] = auth()->id();
         
                return $data;
            }),
        ];
    }
}
