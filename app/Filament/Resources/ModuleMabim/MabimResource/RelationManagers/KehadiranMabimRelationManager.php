<?php

namespace App\Filament\Resources\ModuleMabim\MabimResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Models\Mabim;
use Archilex\ToggleIconColumn\Columns\ToggleIconColumn;
use Filament\Forms\Set;
use HusamTariq\FilamentTimePicker\Forms\Components\TimePickerField;
use Illuminate\Support\Str;
use Malzariey\FilamentDaterangepickerFilter\Fields\DateRangePicker;

class KehadiranMabimRelationManager extends RelationManager
{
    protected static string $relationship = 'kehadiranMabim';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
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

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('nama_kehadiran')
            ->columns([
                Tables\Columns\TextColumn::make('nama_kehadiran')
                    ->searchable(),
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
                Tables\Filters\SelectFilter::make('is_active')
                    ->options([
                        1 => 'Aktif',
                        0 => 'Tidak Aktif',
                     ])
                    ->label('Status'),
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
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
}
