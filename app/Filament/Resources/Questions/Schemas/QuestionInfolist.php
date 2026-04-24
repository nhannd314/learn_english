<?php

namespace App\Filament\Resources\Questions\Schemas;

use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class QuestionInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('game_id')
                    ->numeric(),
                TextEntry::make('question'),
                TextEntry::make('hint')
                    ->placeholder('-'),
                ImageEntry::make('image_url')
                    ->placeholder('-'),
                TextEntry::make('audio_url')
                    ->placeholder('-'),
                TextEntry::make('created_at')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('updated_at')
                    ->dateTime()
                    ->placeholder('-'),
            ]);
    }
}
