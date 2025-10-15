<?php

namespace App\Filament\Resources\Lessons\Schemas;

use App\Models\Unit;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\RichEditor;
use Filament\Schemas\Schema;

class LessonForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('unit_id')
                    ->label('Unit')
//                    ->relationship(name: 'unit', titleAttribute: 'title')
//                    ->getOptionLabelUsing(function(?string $value, Unit $unit) {
//                        if ($unit->course) {
//                            return "{$unit->course->title} > {$unit->title}";
//                        }
//                        return $unit->title;
//                    })
                    ->options(
                        \App\Models\Course::with('units')->get()->mapWithKeys(function ($course) {
                            return [
                                $course->title => $course->units->pluck('title', 'id')->toArray(),
                            ];
                        })
                    )
                    ->required(),
                TextInput::make('title')
                    ->required(),
                TextInput::make('lesson_number')
                    ->required()
                    ->numeric(),
                Textarea::make('vocabulary')
                    ->rows(12)
                    ->columnSpanFull(),
                RichEditor::make('content')
                    ->extraAttributes(['style' => 'min-height: 400px;'])
                    ->fileAttachmentsDisk('public') // nơi lưu file
                    ->fileAttachmentsDirectory('uploads/lessons') // thư mục con
                    ->fileAttachmentsVisibility('public') // để truy cập được ảnh qua URL
                    ->columnSpanFull(),
            ]);
    }
}
