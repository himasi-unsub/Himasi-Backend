<?php

namespace App\Filament\Resources\ModuleMakrab\PembayaranMakrabResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class DetailPembayaranMakrabRelationManager extends RelationManager
{
    protected static string $relationship = 'detailPembayaranMakrab';

    public function form(Form $form): Form
    {
        return $form
            ->schema([

                Forms\Components\Select::make('id_mahasiswa')
                    ->relationship('mahasiswa', 'nama')
                    ->searchable()
                    ->preload()
                    ->required(),
                Forms\Components\Select::make('status_pembayaran')
                    ->required(),
                Forms\Components\FileUpload::make('bukti_pembayaran')
                    ->required(),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('status_pembayaran')
            ->columns([
                Tables\Columns\TextColumn::make('status_pembayaran'),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
