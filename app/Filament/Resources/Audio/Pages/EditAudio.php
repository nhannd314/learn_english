<?php

namespace App\Filament\Resources\Audio\Pages;

use App\Filament\Resources\Audio\AudioResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditAudio extends EditRecord
{
    protected static string $resource = AudioResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
