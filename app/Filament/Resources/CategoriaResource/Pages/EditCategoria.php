<?php

namespace App\Filament\Resources\CategoriaResource\Pages;

use App\Filament\Resources\CategoriaResource;
use Filament\Actions;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\EditRecord;

class EditCategoria extends EditRecord
{
    protected static string $resource = CategoriaResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    // Overriding to disable the default notification behavior after creation.
    protected function getSavedNotification(): ?Notification
    {
        return null; // Disables the notification
    }

    protected function afterSave()
    {
        Notification::make()
            ->title('Categoria actualizada')
            ->body('La categoria ha sido actualizado exitosamente.')
            ->success()
            ->send();
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make()
            ->successNotification(
                Notification::make()
                    ->title('Categoria eliminada')
                    ->body('La categoria ha sido eliminada exitosamente.')
                    ->success()
            ),
        ];
    }
}
