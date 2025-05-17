<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CategoriaResource\Pages;
use App\Filament\Resources\CategoriaResource\RelationManagers;
use App\Models\Categoria;
use Filament\Forms\Form;
use Filament\Forms\Components\Card;
use Filament\Forms;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Filament\Notifications\Notification;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class CategoriaResource extends Resource
{
    protected static ?string $model = Categoria::class;

    protected static ?string $navigationIcon = 'heroicon-o-briefcase';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([

                Forms\Components\Section::make('Llene los campos del formulario')
                ->schema([
                    Forms\Components\Grid::make()
                        ->schema([
                            Forms\Components\TextInput::make('nombre')
                                ->required()
                                ->label('Nombre de la categoria')
                                ->placeholder('Ingrese el nombre de la categoria')
                                ->maxLength(255),
                            Forms\Components\Select::make('tipo')
                                ->options([
                                    'ingreso' => 'Ingreso',
                                    'gasto' => 'Gasto',
                                ])
                                ->label('Tipo de movimiento')
                                ->required(),
                        ])                                    
                ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')
                    ->sortable()
                    ->label('Nro')
                    ->rowIndex(),
                Tables\Columns\TextColumn::make('nombre')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('tipo')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                SelectFilter::make('tipo')
                    ->options([
                        'ingreso' => 'Ingreso',
                        'gasto' => 'Gasto',
                    ])
                    ->placeholder('Filtrar por Tipo')
                    ->label('Tipo de movimiento'),
            ])
            ->actions([
                Tables\Actions\EditAction::make()
                ->button()
                ->label('Editar')
                ->icon('heroicon-o-pencil')
                ->color('primary'),
                Tables\Actions\DeleteAction::make()
                ->button()
                ->label('Eliminar')
                ->icon('heroicon-o-trash')
                ->color('danger')
                ->successNotification(
                    Notification::make()
                        ->title('Categoria eliminada')
                        ->body('La categoria ha sido eliminada exitosamente.')
                        ->success()
            ),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
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
            'index' => Pages\ListCategorias::route('/'),
            'create' => Pages\CreateCategoria::route('/create'),
            'edit' => Pages\EditCategoria::route('/{record}/edit'),
        ];
    }
}
