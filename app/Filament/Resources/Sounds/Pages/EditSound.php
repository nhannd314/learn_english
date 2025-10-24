<?php

namespace App\Filament\Resources\Sounds\Pages;

use App\Filament\Resources\Sounds\SoundResource;
use Filament\Actions\CreateAction;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditSound extends EditRecord
{
    protected static string $resource = SoundResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
            CreateAction::make(),
        ];
    }
}
