<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MovimientoResource\Pages;
use App\Filament\Resources\MovimientoResource\RelationManagers;
use App\Models\Movimiento;
use App\Models\User;
use App\Models\Categoria;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Filament\Notifications\Notification;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class MovimientoResource extends Resource
{
    protected static ?string $model = Movimiento::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
        ->schema([
                Forms\Components\Section::make('Llene los campos del formulario')
                    ->schema([
                        Forms\Components\Select::make('user_id')
                            ->label('Usuario')
                            ->required()
                            ->options(User::all()->pluck('name', 'id')),
                        Forms\Components\Select::make('categoria_id')
                            ->label('Categoria')
                            ->required()
                            ->options(Categoria::all()->pluck('nombre', 'id')),
                        Forms\Components\Select::make('tipo')
                            ->required()
                            ->options([
                                'ingreso' => 'Ingreso',
                                'gasto' => 'Gasto',
                            ]),
                        Forms\Components\TextInput::make('monto')
                            ->label('Monto')
                            ->required()
                            ->numeric(),
                        Forms\Components\RichEditor::make('descripcion')
                            ->label('Descripción')
                            ->required()
                            ->columnSpanFull(),
                        Forms\Components\FileUpload::make('foto')
                            ->label('Foto')
                            ->image()
                            ->disk('public')
                            ->directory('movimientos'),
                        Forms\Components\DatePicker::make('fecha')
                            ->required(),
                    ])->columns(2)
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
                Tables\Columns\TextColumn::make('user.name')
                    ->label('Usuario')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('categoria.nombre')
                    ->label('Categoria')
                    ->sortable()
                    ->searchable(),
                
                Tables\Columns\TextColumn::make('tipo')
                    ->label('Tipo')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('monto')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('descripcion')
                    ->limit(50)
                    ->html()
                    ->sortable()
                    ->searchable(),
                Tables\Columns\ImageColumn::make('foto')
                    ->searchable()
                    ->width(100)
                    ->height(100)
                    ->circular(),
                Tables\Columns\TextColumn::make('fecha')
                    ->date()
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
                        ->title('Movimiento eliminada')
                        ->body('El movimiento ha sido eliminado exitosamente.')
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
            'index' => Pages\ListMovimientos::route('/'),
            'create' => Pages\CreateMovimiento::route('/create'),
            'edit' => Pages\EditMovimiento::route('/{record}/edit'),
        ];
    }
}
