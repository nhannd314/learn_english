<?php

namespace App\Filament\Resources\Lessons\Schemas;

use App\Models\Unit;
use App\Models\Word;
use Filament\Actions\Action;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\RichEditor;
use Filament\Notifications\Notification;
use Filament\Schemas\Components\Actions;
use Filament\Schemas\Schema;
use Filament\Forms;

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

                // Danh sách từ đã có
                Select::make('vocabulary')
                    ->label('Vocabulary')
                    ->multiple()
                    ->relationship('words', 'word')
                    ->preload(),

                // Nút tạo từ mới
                Actions::make([
                    Action::make('newWords')
                        ->label('+ New words')
                        ->button()
                        ->modalHeading('Add new words')
                        ->modalWidth('xl')
                        ->form([
                            Repeater::make('words')
                                ->label(false)
                                ->schema([
                                    TextInput::make('word')->label('Word')->required(),
                                    TextInput::make('ipa')->label('IPA'),
                                    Repeater::make('vn')
                                        ->label('Meaning')
                                        ->schema([
                                            TextInput::make('pos')->label('Pos')->placeholder('(n), (v)...'),
                                            TextInput::make('meaning')->label('Meaning'),
                                        ])
                                        ->minItems(1)
                                        ->collapsible()
                                        ->createItemButtonLabel('Add meaning'),
                                ])
                                ->createItemButtonLabel('Add new word')
                                ->minItems(1),
                        ])
                        ->action(function (array $data, $livewire) {
                            $lesson = $livewire->record;
                            $ids = [];

                            foreach ($data['words'] as $item) {
                                $word = Word::create([
                                    'word' => $item['word'],
                                    'ipa' => $item['ipa'] ?? '',
                                    'vn'  => $item['vn'] ?? [],
                                ]);
                                $ids[] = $word->id;
                            }

                            if ($lesson) {
                                $lesson->words()->attach($ids);
                            }

                            Notification::make()
                                ->title(count($ids) . ' new words added!')
                                ->success()
                                ->send();
                        }),
                ]),

                RichEditor::make('content')
                    ->extraAttributes(['style' => 'min-height: 400px;'])
                    ->fileAttachmentsDisk('public') // nơi lưu file
                    ->fileAttachmentsDirectory('uploads/lessons') // thư mục con
                    ->fileAttachmentsVisibility('public') // để truy cập được ảnh qua URL
                    ->columnSpanFull(),
            ]);
    }
}
