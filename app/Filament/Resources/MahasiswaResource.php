<?php
namespace App\Filament\Resources;

use App\Filament\Resources\MahasiswaResource\Pages;
use App\Models\Mahasiswa;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use pxlrbt\FilamentExcel\Actions\Tables\ExportBulkAction;
use pxlrbt\FilamentExcel\Columns\Column;
use pxlrbt\FilamentExcel\Exports\ExcelExport;

class MahasiswaResource extends Resource
{
    protected static ?string $model = Mahasiswa::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationGroup = 'Master Data';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('npm')
                    ->required()
                    ->maxLength(10),
                Forms\Components\TextInput::make('nama')
                    ->required()
                    ->maxLength(50),
                Forms\Components\TextInput::make('tahun_angkatan')
                    ->required(),
             ]);
    }

    public static function table(Table $table): Table
    {
        $year_angkatan = [  ];
        for ($i = 2021; $i <= date('Y'); $i++) {
            $year_angkatan[ $i ] = $i;
        }
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')
                    ->label('ID')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('npm')
                    ->label('NPM')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('nama')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('tahun_angkatan')
                    ->sortable()
                    ->searchable(),
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
                SelectFilter::make('tahun_angkatan')
                    ->options($year_angkatan),
             ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
             ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    ExportBulkAction::make()
                        ->exports(
                            [
                                ExcelExport::make()
                                    ->withColumns([
                                        Column::make('id')->heading('ID'),
                                        Column::make('npm')->heading('NPM'),
                                        Column::make('nama')->heading('Nama'),
                                        Column::make('tahun_angkatan')->heading('Tahun Angkatan'),
                                     ]),
                             ]
                        ),
                    Tables\Actions\DeleteBulkAction::make(),
                 ]),

             ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageMahasiswas::route('/'),
         ];
    }
}