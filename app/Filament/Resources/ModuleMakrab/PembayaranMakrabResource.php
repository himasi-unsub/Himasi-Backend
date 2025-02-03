<?php

namespace App\Filament\Resources\ModuleMakrab;

use App\Filament\Resources\ModuleMakrab\PembayaranMakrabResource\Pages;
use App\Filament\Resources\ModuleMakrab\PembayaranMakrabResource\RelationManagers;
use App\Models\PembayaranMakrab;
use Archilex\ToggleIconColumn\Columns\ToggleIconColumn;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use HusamTariq\FilamentTimePicker\Forms\Components\TimePickerField;
use Malzariey\FilamentDaterangepickerFilter\Fields\DateRangePicker;

class PembayaranMakrabResource extends Resource
{
    protected static ?string $model = PembayaranMakrab::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationGroup = 'Kegiatan Makrab';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('nama_pembayaran')
                    ->required()
                    ->maxLength(255),
                Forms\Components\Select::make('id_makrab')
                    ->relationship('makrab', 'nama_kegiatan')
                    ->searchable()
                    ->preload()
                    ->required(),
                Forms\Components\TextInput::make('nominal_pembayaran')
                    ->prefix('Rp.')
                    ->numeric()
                    ->required()
                    ->maxLength(255)
                    ->columnSpanFull(),
                DateRangePicker::make('tanggal_mulai')
                    ->singleCalendar()
                    ->alwaysShowCalendar()
                    ->format('YYYY-MM-DD')
                    ->displayFormat('YYYY-MM-DD')
                    ->timezone('Asia/Jakarta')
                    ->defaultToday()
                    ->autoApply()
                    ->required(),
                DateRangePicker::make('tanggal_selesai')
                    ->singleCalendar()
                    ->alwaysShowCalendar()
                    ->format('YYYY-MM-DD')
                    ->displayFormat('YYYY-MM-DD')
                    ->timezone('Asia/Jakarta')
                    ->defaultToday()
                    ->autoApply()
                    ->required(),
                TimePickerField::make('jam_mulai')
                    ->required(),
                TimePickerField::make('jam_selesai')
                    ->required(),
                Forms\Components\Toggle::make('is_active')
                    ->label('Status')
                    ->default(true)
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nama_pembayaran')
                    ->searchable(),
                Tables\Columns\TextColumn::make('nominal_pembayaran')
                    ->searchable(),
                Tables\Columns\TextColumn::make('makrab.tahun_kegiatan')
                    ->label('Tahun Kegiatan')
                    ->searchable()
                    ->sortable(),
                    Tables\Columns\TextColumn::make('tanggal_mulai')
                    ->date()
                    ->sortable()
                    ->toggleable(),
                Tables\Columns\TextColumn::make('tanggal_selesai')
                    ->date()
                    ->sortable()
                    ->toggleable(),
                Tables\Columns\TextColumn::make('jam_mulai')
                    ->toggleable(),
                Tables\Columns\TextColumn::make('jam_selesai')
                    ->toggleable(),
                ToggleIconColumn::make('is_active')
                    ->label('Status')
                    ->onIcon('heroicon-s-check-circle')
                    ->offIcon('heroicon-s-x-circle')
                    ->toggleable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            RelationManagers\DetailPembayaranMakrabRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPembayaranMakrabs::route('/'),
            'create' => Pages\CreatePembayaranMakrab::route('/create'),
            'view' => Pages\ViewPembayaranMakrab::route('/{record}'),
            'edit' => Pages\EditPembayaranMakrab::route('/{record}/edit'),
        ];
    }
}
