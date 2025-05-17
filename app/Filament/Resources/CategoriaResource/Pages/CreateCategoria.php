<?php

namespace App\Filament\Resources\CategoriaResource\Pages;

use App\Filament\Resources\CategoriaResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Filament\Notifications\Notification;

class CreateCategoria extends CreateRecord
{
    protected static string $resource = CategoriaResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
    // Overriding to disable the default notification behavior after creation.
    protected function getCreatedNotification(): ?Notification
    {
        return null;
    }
    

    protected function afterCreate()
    {
        Notification::make()
            ->title('Categoria creada')
            ->body('La categoria ha sido creada exitosamente.')
            ->success()
            ->send();
    }

    protected function getFormActions(): array
    {
        return [
            $this->getCreateFormAction()
                ->label('Registrar')
                ->color('success')
                ->icon('heroicon-o-check'),
            //$this->getCreateAnotherFormAction()
            //    ->label('Guardar y nuevo'),
            $this->getCancelFormAction()
                ->label('Cancelar')
                ->color('secondary')
                ->url($this->getResource()::getUrl('index'))
                ->icon('heroicon-o-x-mark'),
        ];
    }
}
