<?php

namespace App\Filament\Resources\Courses\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

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
                    ->imageCropAspectRatio('3:4')
                    ->disk('public')
                    ->directory('courses')
                    ->visibility('public')
                    ->maxSize(1024)
                    ->getUploadedFileNameForStorageUsing(
                        function ($file, Get $get): string {
                            // Lấy title và tạo slug
                            $title = $get('title');
                            $slug = Str::slug($title);

                            // Lấy extension của file
                            $extension = $file->getClientOriginalExtension();

                            // Trả về tên file: slug + extension
                            return $slug . '-' . now()->timestamp . '.' . $extension;
                        }
                    ),
                TextInput::make('order')
                    ->numeric()->default(0),
            ]);
    }
}
