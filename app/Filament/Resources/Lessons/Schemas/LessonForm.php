<?php

namespace App\Filament\Resources\Lessons\Schemas;

use App\Models\Word;
use App\Models\Sound;
use Filament\Actions\Action;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\RichEditor;
use Filament\Notifications\Notification;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Schema;

class LessonForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('unit_id')
                    ->label('Unit')
                    ->options(
                        \App\Models\Course::with('units')->get()->mapWithKeys(function ($course) {
                            return [
                                $course->title => $course->units->pluck('title', 'id')->toArray(),
                            ];
                        })
                    )
                    ->required(),
                TextInput::make('order')
                    ->numeric()->default(0),
                TextInput::make('title')
                    ->required()
                    ->columnSpanFull(),

                // Danh sách từ đã có
                Select::make('vocabulary')
                    ->label('Vocabulary')
                    ->multiple()
                    ->relationship('words', 'source')
                    ->preload()
                    ->columnSpanFull(),

                // Nút tạo từ mới
                Action::make('newWords')
                    ->label('+ New words')
                    ->button()
                    ->modalHeading('Add new words')
                    ->modalWidth('2xl')
                    ->schema([
                        Grid::make(2)
                            ->schema([
                                TextInput::make('source')->label('Source')->required(),
                                TextInput::make('ipa')->label('IPA')->placeholder('/ipa/'),
                            ]),
                        Repeater::make('mean')
                            ->label('Mean')
                            ->schema([
                                Grid::make(2)
                                    ->schema([
                                        TextInput::make('pos')->label('Pos')->placeholder('n, v, a, adv, prep'),
                                        TextInput::make('vn')->label('VN'),
                                    ]),
                            ])
                            //->minItems(1)
                            ->addActionLabel('Add mean'),
                    ])
                    ->action(function (array $data, $livewire) {
                        try {
                            $word = Word::createOrFail([
                                'source' => $data['source'],
                                'ipa' => $data['ipa'],
                                'mean'  => $data['mean'],
                            ]);
                            Notification::make()
                                ->title("Word {$word->source} added!")
                                ->success()
                                ->send();
                        } catch (\Exception $e) {
                            Notification::make()
                                ->title($e->getMessage())
                                ->danger()
                                ->send();
                        }
                    }),

                RichEditor::make('content')
                    ->extraAttributes(['style' => 'min-height: 400px;'])
                    ->fileAttachmentsDisk('public') // nơi lưu file
                    ->fileAttachmentsDirectory('lessons') // thư mục con
                    ->fileAttachmentsVisibility('public') // để truy cập được ảnh qua URL
                    ->columnSpanFull(),
            ]);
    }
}
