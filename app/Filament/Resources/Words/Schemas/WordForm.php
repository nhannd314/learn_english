<?php

namespace App\Filament\Resources\Words\Schemas;

use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Schema;

class WordForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('source')
                    ->unique()
                    ->required(),
                TextInput::make('ipa'),
                Repeater::make('mean')
                    ->label('Mean')
                    ->schema([
                        Grid::make(2)
                            ->schema([
                                TextInput::make('pos')
                                    ->label('Pos')
                                    ->placeholder('(n), (v)...')
                                    ->maxLength(10),

                                TextInput::make('vn')
                                    ->label('VN')
                                    ->placeholder('Vietnamese meaning...')
                                    ->required(),
                            ]),
                    ])
                    ->minItems(1)
                    ->addActionLabel('Add mean')
                    ->columnSpanFull(),
            ]);
    }
}
