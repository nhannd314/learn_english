<?php

namespace App\Filament\Resources\Listens\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class ListenForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('title')
                    ->required(),
                FileUpload::make('file')
                    ->acceptedFileTypes([ // Chỉ định các MIME types được chấp nhận
                        'audio/mpeg', // MIME type phổ biến cho .mp3
                        'audio/wav',  // MIME type cho .wav
                        'audio/mp3',  // Một số trình duyệt/hệ thống vẫn dùng
                        'audio/ogg',
                    ])
                    ->directory('listens') // Thư mục lưu trữ trong disk (ví dụ: storage/app/public/audio)
                    ->disk('public')
                    ->visibility('public') // Đặt tệp tin có thể truy cập công khai
                    ->maxSize(10240) // Kích thước tối đa cho phép (ví dụ: 10MB)
                    ->maxFiles(1) // Cho phép tải lên 1 tệp duy nhất
                    ->required(),
                RichEditor::make('transcript')
                    ->extraAttributes(['style' => 'min-height: 400px;'])
                    ->fileAttachmentsDisk('public') // nơi lưu file
                    ->fileAttachmentsDirectory('listens') // thư mục con
                    ->fileAttachmentsVisibility('public') // để truy cập được ảnh qua URL
                    ->columnSpanFull(),
            ]);
    }
}
