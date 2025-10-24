<?php

namespace App\Filament\Resources\Sounds;

use App\Filament\Resources\Sounds\Pages\CreateSound;
use App\Filament\Resources\Sounds\Pages\EditSound;
use App\Filament\Resources\Sounds\Pages\ListSounds;
use App\Filament\Resources\Sounds\Schemas\SoundForm;
use App\Filament\Resources\Sounds\Tables\SoundsTable;
use App\Models\Sound;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class SoundResource extends Resource
{
    protected static ?int $navigationSort = 5;
    protected static ?string $model = Sound::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRss;

    protected static ?string $recordTitleAttribute = 'Sound';

    public static function form(Schema $schema): Schema
    {
        return SoundForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return SoundsTable::configure($table);
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
            'index' => ListSounds::route('/'),
            'create' => CreateSound::route('/create'),
            'edit' => EditSound::route('/{record}/edit'),
        ];
    }
}
