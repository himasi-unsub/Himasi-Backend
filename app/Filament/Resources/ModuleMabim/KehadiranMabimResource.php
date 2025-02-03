<?php

namespace App\Filament\Resources\ModuleMabim;

use App\Filament\Resources\ModuleMabim\KehadiranMabimResource\Pages;
use App\Filament\Resources\ModuleMabim\KehadiranMabimResource\RelationManagers;
use App\Models\KehadiranMabim;
use App\Models\Mabim;
use Archilex\ToggleIconColumn\Columns\ToggleIconColumn;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Set;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use HusamTariq\FilamentTimePicker\Forms\Components\TimePickerField;
use Illuminate\Support\Str;
use Malzariey\FilamentDaterangepickerFilter\Fields\DateRangePicker;

class KehadiranMabimResource extends Resource
{
    protected static ?string $model = KehadiranMabim::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationGroup = 'Kegiatan Mabim';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('id_mabim')
                    ->relationship('mabim', 'nama_kegiatan')
                    ->searchable()
                    ->preload()
                    ->live(onBlur: true)
                    ->afterStateUpdated(
                        function (Set $set, ?string $state) {
                            $nama_kegiatan = Mabim::find($state)->nama_kegiatan;

                            $set(
                                'nama_kehadiran', 'Kehadiran ' . $nama_kegiatan,
                            );

                            $set(
                                'kode_kehadiran', Str::slug($nama_kegiatan) . '-' . Str::random(5),
                            );
                        }
                    )
                    ->required(),
                Forms\Components\TextInput::make('nama_kehadiran')
                    ->required()
                    ->live(onBlur: true)
                    ->afterStateUpdated(
                        fn(Set $set, ?string $state) => $set(
                            'kode_kehadiran', Str::slug($state) . '-' . Str::random(5),
                        )
                    )
                    ->maxLength(255),
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
                Forms\Components\TextInput::make('kode_kehadiran')
                    ->required()
                    ->maxLength(255),
                Forms\Components\Toggle::make('is_active')
                    ->label('Status')
                    ->default(true)
                    ->required(),
                Forms\Components\TextInput::make('keterangan')
                    ->maxLength(255)
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nama_kehadiran')
                    ->searchable(),
                Tables\Columns\TextColumn::make('mabim.nama_kegiatan')
                    ->label('Kegiatan Acara')
                    ->searchable()
                    ->sortable()
                    ->toggleable(),
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
                Tables\Columns\TextColumn::make('kode_kehadiran')
                    ->searchable()
                    ->toggleable(),
                ToggleIconColumn::make('is_active')
                    ->onIcon('heroicon-o-check-circle')
                    ->offIcon('heroicon-o-x-circle')
                    ->onColor('success')
                    ->offColor('danger')
                    ->label('Status')
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
                Tables\Filters\SelectFilter::make('mabim.nama_kegiatan')
                    ->relationship('mabim', 'nama_kegiatan')
                    ->searchable()
                    ->label('Kegiatan Mabim'),
                Tables\Filters\SelectFilter::make('is_active')
                    ->options([
                        1 => 'Aktif',
                        0 => 'Tidak Aktif',
                     ])
                    ->label('Status'),
            ])
            ->actions([
                Tables\Actions\ActionGroup::make([
                    Tables\Actions\ViewAction::make(),
                    Tables\Actions\EditAction::make(),
                ]),
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
            RelationManagers\DetailKehadiranMabimRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListKehadiranMabims::route('/'),
            'create' => Pages\CreateKehadiranMabim::route('/create'),
            'view' => Pages\ViewKehadiranMabim::route('/{record}'),
            'edit' => Pages\EditKehadiranMabim::route('/{record}/edit'),
        ];
    }
}
