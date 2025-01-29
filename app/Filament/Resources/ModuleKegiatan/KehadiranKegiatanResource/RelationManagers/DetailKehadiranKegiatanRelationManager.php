<?php
namespace App\Filament\Resources\ModuleKegiatan\KehadiranKegiatanResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;

class DetailKehadiranKegiatanRelationManager extends RelationManager
{
 protected static string $relationship = 'detailKehadiranKegiatan';

 public function form(Form $form): Form
 {
  return $form
   ->schema([
    Forms\Components\TextInput::make('id')
     ->required()
     ->maxLength(255),
    ]);
 }

 public function table(Table $table): Table
 {
  return $table
   ->recordTitleAttribute('id')
   ->columns([
    Tables\Columns\TextColumn::make('mahasiswa.nama')
     ->label('Nama Mahasiswa'),
    Tables\Columns\TextColumn::make('status_kehadiran')
     ->label('Status Kehadiran'),
    // Tables\Columns\TextColumn::make('keterangan')
    //     ->label('Keterangan'),
    // Tables\Columns\ImageColumn::make('file_bukti_kehadiran')
    //     ->label('Bukti Kehadiran'),
    ])
   ->filters([
    //
    ])
   ->headerActions([
    // Tables\Actions\CreateAction::make(),
    ])
   ->actions([
    Tables\Actions\ViewAction::make(),
    Tables\Actions\DeleteAction::make(),
    ])
   ->bulkActions([
    Tables\Actions\BulkActionGroup::make([
     Tables\Actions\DeleteBulkAction::make(),
     ]),
    ]);
 }
}
