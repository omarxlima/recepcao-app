<?php

namespace App\Filament\Resources;

use App\Filament\Resources\FuncionarioResource\Pages;
use App\Filament\Resources\FuncionarioResource\RelationManagers;
use App\Models\Funcionario;
use Filament\Forms;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Select;
use Filament\Forms\Form;
use Filament\Infolists\Components\Group;
use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Infolist;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class FuncionarioResource extends Resource
{
    protected static ?string $model = Funcionario::class;
    protected static ?string $modelLabel = 'Funcionário';
    protected static ?string $pluralModelLabel = 'Funcionários';
    protected static ?string $navigationIcon = 'heroicon-o-users';
    protected static ?string $navigationGroup = 'Identificação';


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\FileUpload::make('image')
                    ->label('Imagem')
                    ->columnSpan(2)
                    ->image(),
                Grid::make()->schema([

                    Forms\Components\TextInput::make('nome')
                        ->required()
                        ->maxLength(255),
                    Forms\Components\TextInput::make('cpf')
                        ->required()
                        ->maxLength(11),
                ])->columns(2),
                Grid::make()->schema([
                    Forms\Components\TextInput::make('cargo')
                        ->maxLength(255),
                    Forms\Components\TextInput::make('matricula')
                        ->maxLength(255),
                    Forms\Components\TextInput::make('instituicao')
                        ->maxLength(255),
                    Forms\Components\TextInput::make('telefone')
                        ->mask('(99)99999-9999')
                        ->placeholder('(99)99999-9999')
                        ->maxLength(255),
                    Forms\Components\TextInput::make('pis_pasep')
                        ->maxLength(11),
                    Forms\Components\TextInput::make('banco')
                        ->maxLength(255),
                    Forms\Components\TextInput::make('agencia')
                        ->maxLength(255),
                    Forms\Components\TextInput::make('conta')
                        ->maxLength(255),
                    Select::make('tipo_conta')
                        ->options([
                            'CORRENTE' => 'CORRENTE',
                            'POUPANÇA' => 'POUPANÇA',
                        ]),
                ])->columns(3),
                Forms\Components\TextInput::make('email_funcional')
                    ->email()
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('email_pessoal')
                    ->email()
                    ->required()
                    ->maxLength(255),

                Forms\Components\Toggle::make('ativo')
                    ->required(),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('image')
                ->circular(),
                Tables\Columns\TextColumn::make('nome')
                    ->searchable(),
                Tables\Columns\TextColumn::make('cpf')
                    ->searchable(),
                Tables\Columns\TextColumn::make('cargo')
                    ->searchable(),
                Tables\Columns\TextColumn::make('matricula')
                    ->searchable(),
                Tables\Columns\TextColumn::make('instituicao')
                    ->searchable(),
                Tables\Columns\TextColumn::make('telefone')
                    ->searchable(),
                Tables\Columns\TextColumn::make('email_funcional')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('email_pessoal')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('pis_pasep')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('banco')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('agencia')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('conta')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('tipo_conta')
                    ->toggleable(isToggledHiddenByDefault: true),

                Tables\Columns\IconColumn::make('ativo')
                    ->boolean(),
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
                // Tables\Actions\DeleteAction::make(),
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
            'index' => Pages\ManageFuncionarios::route('/'),
        ];
    }


public static function infolist(Infolist $infolist): Infolist
{
    return $infolist
        ->schema([
            Section::make([
                ImageEntry::make('image')
                    ->label('Imagem')
            ])
            ->columnSpan(1),
            Section::make([
                Group::make([
                    TextEntry::make('nome')
                        ->label('Nome:')
                        ->weight('bold'),
                        TextEntry::make('cpf')
                        ->label('CPF:'),
                        TextEntry::make('cargo')
                        ->label('Cargo:'),
                        TextEntry::make('instituicao')
                        ->label('Instituição:'),
                        TextEntry::make('email_funcional')
                        ->label('Email Funcional:'),
                        TextEntry::make('email_pessoal')
                        ->label('Email Pessoal:'),
                        TextEntry::make('pis_pasep')
                        ->label('PIS/PASEP:'),
                        TextEntry::make('banco')
                        ->label('Banco:'),
                        TextEntry::make('agencia')
                        ->label('Agencia:'),
                        TextEntry::make('conta')
                        ->label('Conta:'),
                        TextEntry::make('tipo_conta')
                        ->label('PIS/PASEP:'),
                        TextEntry::make('banco')
                        ->label('Banco:'),
                ])->columns(2)
            ])
            ->columnSpan(2),

        ])
        ->columns(3)
        ;
}
}
