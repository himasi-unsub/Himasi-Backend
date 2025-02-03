<?php
namespace App\Filament\Resources\ModuleKegiatan\KegiatanAcaraResource\RelationManagers;

use Archilex\ToggleIconColumn\Columns\ToggleIconColumn;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;
use HusamTariq\FilamentTimePicker\Forms\Components\TimePickerField;
use Malzariey\FilamentDaterangepickerFilter\Fields\DateRangePicker;

class RegistrationKegiatanRelationManager extends RelationManager
{
    protected static string $relationship = 'registrationKegiatan';

    public static function canViewForRecord(Model $ownerRecord, string $pageClass): bool
    {
        return $ownerRecord->has_registration;
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('nama_pembayaran')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('nominal_pembayaran')
                    ->prefix('Rp.')
                    ->numeric()
                    ->required()
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
                Forms\Components\Toggle::make('is_active')
                    ->label('Status')
                    ->default(true)
                    ->required(),
             ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('id')
            ->columns([
                Tables\Columns\TextColumn::make('nama_pembayaran')
                    ->searchable(),
                Tables\Columns\TextColumn::make('nominal_pembayaran')
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
                ToggleIconColumn::make('is_active')
                    ->label('Status')
                    ->onIcon('heroicon-s-check-circle')
                    ->offIcon('heroicon-s-x-circle')
                    ->toggleable(),
             ])
            ->filters([
                //
             ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
             ])
            ->actions([
                Tables\Actions\ActionGroup::make([
                    Tables\Actions\ViewAction::make(),
                    Tables\Actions\EditAction::make(),
                    Tables\Actions\DeleteAction::make(),
                 ]),
             ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                 ]),
             ]);
    }
}
