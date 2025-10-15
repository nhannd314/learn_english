<?php

namespace App\Filament\Resources\Audio\Tables;

use App\Models\Audio;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class AudioTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('title')
                    ->searchable(),
                TextColumn::make('file_url')
                    ->searchable(),
                TextColumn::make('shortcode')
                    ->label('Shortcode')
                    ->getStateUsing(fn (Audio $record) => "[audio id={$record->id}]")
                    ->searchable(false)
                    ->sortable(false)
                    ->copyable() // cho phép copy nhanh
                    ->copyMessage('Copied')
                    ->copyMessageDuration(1500),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
