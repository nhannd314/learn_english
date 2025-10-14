<?php

namespace App\Filament\Resources\Courses\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class CourseForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('title')
                    ->required(),
                TextInput::make('slug')
                    ->disabled()
                    ->dehydrated(false),
                Textarea::make('description')
                    ->columnSpanFull(),
                FileUpload::make('thumbnail')
                    ->label('Thumbnail')
                    ->image()
                    ->disk('public')
                    ->directory('courses')
                    ->visibility('public')
                    ->maxSize(512),
            ]);
    }
}
