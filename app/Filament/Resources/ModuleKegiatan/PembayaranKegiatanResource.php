<?php
namespace App\Filament\Resources\ModuleKegiatan;

use App\Filament\Resources\ModuleKegiatan\PembayaranKegiatanResource\Pages;
use App\Filament\Resources\ModuleKegiatan\PembayaranKegiatanResource\RelationManagers\DetailPembayaranKegiatanRelationManager;
use App\Models\PembayaranKegiatan;
use Archilex\ToggleIconColumn\Columns\ToggleIconColumn;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class PembayaranKegiatanResource extends Resource
{
    protected static ?string $model = PembayaranKegiatan::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationGroup = 'Kegiatan atau Acara';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('nama_pembayaran')
                    ->required()
                    ->maxLength(255),
                Forms\Components\Select::make('id_kegiatan_acara')
                    ->relationship('kegiatanAcara', 'nama_kegiatan')
                    ->searchable()
                    ->preload()
                    ->required(),
                Forms\Components\TextInput::make('nominal_pembayaran')
                    ->prefix('Rp.')
                    ->numeric()
                    ->required()
                    ->maxLength(255)
                    ->columnSpanFull(),
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
                Tables\Columns\TextColumn::make('kegiatanAcara.nama_kegiatan')
                    ->label('Kegiatan Acara')
                    ->searchable()
                    ->sortable(),
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
                Tables\Actions\ActionGroup::make([
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
            DetailPembayaranKegiatanRelationManager::class,
         ];
    }

    public static function getPages(): array
    {
        return [
            'index'  => Pages\ListPembayaranKegiatans::route('/'),
            'create' => Pages\CreatePembayaranKegiatan::route('/create'),
            'view'   => Pages\ViewPembayaranKegiatan::route('/{record}'),
            'edit'   => Pages\EditPembayaranKegiatan::route('/{record}/edit'),
         ];
    }
}
