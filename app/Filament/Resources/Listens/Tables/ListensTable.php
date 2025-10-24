<?php

namespace App\Filament\Resources\Listens\Tables;

use App\Models\Listen;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class ListensTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id'),
                TextColumn::make('title')
                    ->searchable(),
                TextColumn::make('file')
                    ->searchable(),
                TextColumn::make('shortcode')
                    ->label('Shortcode')
                    ->getStateUsing(fn (Listen $record) => "[listen id={$record->id}]")
                    ->searchable(false)
                    ->sortable(false)
                    ->copyable() // cho phép copy nhanh
                    ->copyMessage('Shortcode copied!')
                    //->copyMessageDuration(1500)
                ,
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
