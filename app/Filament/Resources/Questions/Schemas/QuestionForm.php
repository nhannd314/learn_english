<?php

namespace App\Filament\Resources\Questions\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class QuestionForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('game_id')
                    ->required()
                    ->relationship('game', 'name'),
                TextInput::make('question')
                    ->required(),
                TextInput::make('hint'),
                FileUpload::make('image_url')
                    ->image()
                    ->disk('public')
                    ->directory('questions')
                    ->visibility('public')
                    ->maxSize(1024),
                FileUpload::make('audio_url')
                    ->acceptedFileTypes([ // Chỉ định các MIME types được chấp nhận
                        'audio/mpeg', // MIME type phổ biến cho .mp3
                        'audio/wav',  // MIME type cho .wav
                        'audio/mp3',  // Một số trình duyệt/hệ thống vẫn dùng
                        'audio/ogg',
                    ])
                    ->directory('questions') // Thư mục lưu trữ trong disk (ví dụ: storage/app/public/audio)
                    ->disk('public')
                    ->visibility('public') // Đặt tệp tin có thể truy cập công khai
                    ->maxSize(10240) // Kích thước tối đa cho phép (ví dụ: 10MB)
                    ->maxFiles(1) // Cho phép tải lên 1 tệp duy nhất
                    ,
            ]);
    }
}
