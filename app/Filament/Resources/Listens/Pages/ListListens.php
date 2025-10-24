<?php

namespace App\Filament\Resources\Listens\Pages;

use App\Filament\Resources\Listens\ListenResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListListens extends ListRecords
{
    protected static string $resource = ListenResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
