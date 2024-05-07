<?php

namespace App\Filament\Resources;

use App\Filament\Resources\VisitorResource\Pages;
use App\Filament\Resources\VisitorResource\RelationManagers;
use App\Models\Funcionario;
use App\Models\Visitor;
use Filament\Forms;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Section;
use Filament\Forms\Form;
use Filament\Infolists;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Infolist;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class VisitorResource extends Resource
{
    protected static ?string $model = Visitor::class;
    protected static ?string $modelLabel = 'Visitante';
    protected static ?string $pluralModelLabel = 'Visitantes';
    protected static ?string $navigationIcon = 'heroicon-o-hand-raised';
    protected static ?string $navigationGroup = 'Recepção';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\FileUpload::make('image')
                    ->label('Imagem')
                    ->columnSpan(2)
                    ->image(),
                Grid::make()->schema([
                    Forms\Components\TextInput::make('name')
                        ->label('Nome')
                        ->required()
                        ->maxLength(190),
                    Forms\Components\TextInput::make('cpf')
                        ->label('CPF')
                        ->required()
                        ->maxLength(11),
                    Forms\Components\TextInput::make('registration')
                        ->label('Matrícula')
                        ->maxLength(255),
                    Forms\Components\TextInput::make('telephone')
                        ->label('Telefone')
                        ->mask('(99)99999-9999')
                        ->placeholder('(99)99999-9999')
                        ->required()
                        ->maxLength(20),
                    Forms\Components\TextInput::make('function')
                        ->label('Função')
                        ->maxLength(255),
                    Forms\Components\TextInput::make('capacity')
                        ->label('Orgão Lotação')
                        ->maxLength(255),
                    // Forms\Components\TextInput::make('interlocutor')
                    //     ->label('Interlocutor')
                    //     ->required()
                    //     ->maxLength(255),
                    Forms\Components\Select::make('funcionario_id')
                    ->label('Funcionario')
                    ->options(Funcionario::all()->pluck('nome', 'id'))
                    ->required(),
                    Forms\Components\DateTimePicker::make('date_time')
                        ->label('Data Hora')
                        ->seconds(false)
                        ->required(),

                ])->columns(2),


            ]);
    }

    public static function table(Table $table): Table
    {
        return $table

            ->columns([
                Tables\Columns\ImageColumn::make('image')
                    ->label('Imagem')
                    ->circular(),
                Tables\Columns\TextColumn::make('name')
                    ->label('Nome')
                    ->searchable(),
                Tables\Columns\TextColumn::make('cpf')
                    ->label('CPF')
                    ->searchable(),
                Tables\Columns\TextColumn::make('registration')
                    ->label('Matrícula')
                    ->searchable(),
                Tables\Columns\TextColumn::make('telephone')
                    ->label('Telefone')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('function')
                    ->label('Função')
                    ->searchable(),
                Tables\Columns\TextColumn::make('capacity')
                    ->label('Orgão')
                    ->searchable(),
                Tables\Columns\TextColumn::make('Funcionario.nome')
                    ->label('Funcionario')
                    ->searchable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Data de Criação')
                    ->dateTime('d/m/y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Data de Atualização')
                    ->dateTime('d/m/y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),

            ]);
    }
    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                    Infolists\Components\ImageEntry::make('image')
                    ->label('Imagem')
                    ->circular(),
                    Infolists\Components\TextEntry::make('name'),
                    Infolists\Components\TextEntry::make('cpf'),
                    Infolists\Components\TextEntry::make('registration'),
                    Infolists\Components\TextEntry::make('telephone'),
                    Infolists\Components\TextEntry::make('function'),
                    Infolists\Components\TextEntry::make('capacity'),
                    Infolists\Components\TextEntry::make('interlocutor'),
                    Infolists\Components\TextEntry::make('date_time')


                        ->columnSpanFull(),
                ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageVisitors::route('/'),
        ];
    }
}
