<?php

namespace App\Filament\Resources\Listens;

use App\Filament\Resources\Listens\Pages\CreateListen;
use App\Filament\Resources\Listens\Pages\EditListen;
use App\Filament\Resources\Listens\Pages\ListListens;
use App\Filament\Resources\Listens\Schemas\ListenForm;
use App\Filament\Resources\Listens\Tables\ListensTable;
use App\Models\Listen;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class ListenResource extends Resource
{
    protected static ?int $navigationSort = 6;
    protected static ?string $model = Listen::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedMicrophone;

    protected static ?string $recordTitleAttribute = 'Listen';

    public static function form(Schema $schema): Schema
    {
        return ListenForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ListensTable::configure($table);
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
            'index' => ListListens::route('/'),
            'create' => CreateListen::route('/create'),
            'edit' => EditListen::route('/{record}/edit'),
        ];
    }
}
