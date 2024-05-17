<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TaskGroupResource\Pages;
use App\Filament\Resources\TaskGroupResource\RelationManagers;
use App\Models\TaskGroup;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class TaskGroupResource extends Resource
{
    protected static ?string $model = TaskGroup::class;
    protected static ?string $modelLabel = 'Grupo de Tarefa';
    protected static ?string $pluralModelLabel = 'Grupo de Tarefas';

    protected static ?string $navigationIcon = 'heroicon-o-bookmark';

    protected static ?string $navigationGroup = 'Tarefas';


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('title')
                    ->label('Título')
                    ->required()
                    ->maxLength(255),
                Forms\Components\Textarea::make('description')
                    ->label('Descrição')
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')
                ->label('Título')
                    ->searchable(),
                Tables\Columns\TextColumn::make('description')
                ->label('Descrição')
                    ->searchable()
                    ->limit(30),
                Tables\Columns\TextColumn::make('created_at')
                ->label('Criado em')
                    ->dateTime('d/m/y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                ->label('Atualizado em')
                    ->dateTime('d/m/y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageTaskGroups::route('/'),
        ];
    }
}
