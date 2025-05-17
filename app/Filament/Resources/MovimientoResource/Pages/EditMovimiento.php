<?php

namespace App\Filament\Resources\MovimientoResource\Pages;

use App\Filament\Resources\MovimientoResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Filament\Notifications\Notification;


class EditMovimiento extends EditRecord
{
    protected static string $resource = MovimientoResource::class;

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
            ->title('Movimiento actualizado')
            ->body('El movimiento ha sido actualizado exitosamente.')
            ->success()
            ->send();
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make()
            ->successNotification(
                Notification::make()
                    ->title('Movimiento eliminado')
                    ->body('El movimiento ha sido eliminado exitosamente.')
                    ->success()
            ),
        ];
    }
}
