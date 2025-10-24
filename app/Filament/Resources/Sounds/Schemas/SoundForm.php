<?php

namespace App\Filament\Resources\Sounds\Schemas;

use App\Models\Sound;
use App\Models\Word;
use Filament\Actions\Action;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class SoundForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('title')
                    ->required()
                    ->columnSpanFull(),
                FileUpload::make('img')
                    ->label('Image')
                    ->image()
                    ->disk('public')
                    ->directory('sounds')
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
                            return $slug . '.' . $extension;
                        }
                    )
                    ,
                FileUpload::make('file')
                    ->acceptedFileTypes([ // Chỉ định các MIME types được chấp nhận
                        'audio/mpeg', // MIME type phổ biến cho .mp3
                        'audio/wav',  // MIME type cho .wav
                        'audio/mp3',  // Một số trình duyệt/hệ thống vẫn dùng
                        'audio/ogg',
                    ])
                    ->directory('sounds') // Thư mục lưu trữ trong disk (ví dụ: storage/app/public/audio)
                    ->disk('public')
                    ->visibility('public') // Đặt tệp tin có thể truy cập công khai
                    ->maxSize(10240) // Kích thước tối đa cho phép (ví dụ: 10MB)
                    ->maxFiles(1) // Cho phép tải lên 1 tệp duy nhất
                    ->getUploadedFileNameForStorageUsing(
                        function ($file, Get $get): string {
                            // Lấy title và tạo slug
                            $title = $get('title');
                            $slug = Str::slug($title);

                            // Lấy extension của file
                            $extension = $file->getClientOriginalExtension();

                            // Trả về tên file: slug + extension
                            return $slug . '.' . $extension;
                        }
                    ),
            ]);
    }
}
