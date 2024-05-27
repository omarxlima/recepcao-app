<?php

namespace App\Filament\Resources\VisitorResource\Pages;

use App\Filament\Resources\VisitorResource;
use App\Models\Foto;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateVisitor extends CreateRecord
{
    protected static string $resource = VisitorResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

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

    // protected function mutateFormDataBeforeCreate(array $data): array
    // {
    //     if (isset($data['image'])) {
    //         $image = Foto::create(['path' => $data['foto']]);
    //         $data['visitor_id'] = $image->id;
    //         unset($data['foto']);
    //     }

    //     return $data;
    // }
}
