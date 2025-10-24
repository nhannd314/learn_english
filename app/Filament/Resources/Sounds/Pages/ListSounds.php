<?php

namespace App\Filament\Resources\Sounds\Pages;

use App\Filament\Resources\Sounds\SoundResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListSounds extends ListRecords
{
    protected static string $resource = SoundResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
