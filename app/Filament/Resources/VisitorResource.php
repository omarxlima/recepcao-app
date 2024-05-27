<?php

namespace App\Filament\Resources;

use App\Filament\Resources\VisitorResource\Pages;
use App\Filament\Resources\VisitorResource\RelationManagers;
use App\Forms\Components\webCam;
use App\Models\Visitor;
use Dompdf\FrameDecorator\Text;
use Filament\Actions\ReplicateAction;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Infolists\Components\Group;
use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Infolist;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class VisitorResource extends Resource
{
    protected static ?string $model = Visitor::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $modelLabel = 'Visitante';
    protected static ?string $pluralModelLabel = 'Visitantes';
    protected static ?string $navigationGroup = 'Identificação';


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                // inicio select da web cam ou imagem do pc
                Select::make('type')
                    ->options([
                        'webcam' => 'Webcam Image',
                        'image' => 'Imagem',
                    ])
                    ->live()
                    ->afterStateUpdated(fn (Select $component) => $component
                        ->getContainer()
                        ->getComponent('dynamicTypeFields')
                        ->getChildComponentContainer()
                        ->fill()),

                Grid::make(2)
                    ->schema(fn (Get $get): array => match ($get('type')) {
                        'webcam' => [
                            webCam::make('webcam_image')
                            ->imageEditor()

                            // ->label('Webcam Image'),
                        ],
                        // 'image' => [
                        //     FileUpload::make('image')
                        //         ->imageEditor()
                        //         ->image()
                        //         // ->getUploadedFileNameForStorageUsing(fn (Forms\Components\FileUpload $component, $file): string => $file->store('uploads/images'))
                        //         ->columnSpan(1),
                        // ],
                        default => [],
                    })
                    ->key('dynamicTypeFields'),
                    Forms\Components\FileUpload::make('image')
                    ->imageEditor()
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
                        ->label('Interlocutor')
                        ->relationship('funcionario', 'nome')
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
                // Tables\Columns\ImageColumn::make('foto.path')
                // ->label('Imagem')
                // ->circular(),

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
                Tables\Columns\TextColumn::make('funcionario.nome')
                    ->label('Interlocutor')
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
                Tables\Actions\ReplicateAction::make()
                ->successRedirectUrl(fn (Model $replica): string => route('visitors.edit', [
                    'visitor' => $replica,
                ]))
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->headerActions([
                
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListVisitors::route('/'),
            'create' => Pages\CreateVisitor::route('/create'),
            'edit' => Pages\EditVisitor::route('/{record}/edit'),
            // 'copy' => Pages\EditVisitor::route('/{record}/copy'),

        ];
    }

 
public static function infolist(Infolist $infolist): Infolist
{
    return $infolist
        ->schema([
            Section::make([
                ImageEntry::make('image')
            ])
            ->columnSpan(1),
            Section::make([
                Group::make([
                    TextEntry::make('name')
                        ->label('Nome:')
                        ->weight('bold'),
                        TextEntry::make('cpf')
                        ->label('CPF:'),
                        TextEntry::make('registration')
                        ->label('Matrícula:'),
                        TextEntry::make('telephone')
                        ->label('Telefone:'),
                        TextEntry::make('function')
                        ->label('Função:'),
                        TextEntry::make('capacity')
                        ->label('Orgão Lotação:'),
                        TextEntry::make('interlocutor')
                        ->label('Interlocutor:'),
                        TextEntry::make('created_at')
                        ->label('Criado Em:')
                        ->date('d/m/Y'),

                ])->columns(2)
            ])
            ->columnSpan(2),

        ])
        ->columns(3)
        ;
}
}
