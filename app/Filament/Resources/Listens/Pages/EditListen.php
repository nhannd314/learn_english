<?php

namespace App\Filament\Resources\Listens\Pages;

use App\Filament\Resources\Listens\ListenResource;
use Filament\Actions\CreateAction;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditListen extends EditRecord
{
    protected static string $resource = ListenResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
            CreateAction::make(),
        ];
    }
}
