<?php
namespace App\Filament\Resources\ModuleMakrab;

use App\Filament\Resources\ModuleMakrab\MakrabResource\Pages;
use App\Filament\Resources\ModuleMakrab\MakrabResource\RelationManagers\PesertaMakrabRelationManager;
use App\Filament\Resources\ModuleMakrab\MakrabResource\RelationManagers\StrukturOrganisasiMakrabsRelationManager;
use App\Models\Makrab;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class MakrabResource extends Resource
{
    protected static ?string $model = Makrab::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationGroup = 'Kegiatan Makrab';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('nama_kegiatan')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('tahun_kegiatan')
                    ->required(),
                Forms\Components\DatePicker::make('tanggal_mulai')
                    ->required(),
                Forms\Components\DatePicker::make('tanggal_selesai')
                    ->required(),
                Forms\Components\TextInput::make('lokasi')
                    ->required()
                    ->maxLength(255),
                Forms\Components\Select::make('status')
                    ->options([
                        'Belum Terlaksana'   => 'Belum Terlaksana',
                        'Sedang Berlangsung' => 'Sedang Berlangsung',
                        'Selesai'            => 'Selesai',
                     ])
                    ->required(),
                Forms\Components\Select::make('id_mahasiswa')
                    ->label('Ketua Pelaksana')
                    ->relationship('mahasiswa', 'nama')
                    ->searchable()
                    ->preload()
                    ->required(),
                Forms\Components\Select::make('id_dokumen_sertifikat')
                    ->relationship('dokumenSertifikat', 'nama_dokumen')
                    ->searchable()
                    ->preload(),
                Forms\Components\Textarea::make('deskripsi')
                    ->columnSpanFull(),
             ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nama_kegiatan')
                    ->searchable(),
                Tables\Columns\TextColumn::make('tahun_kegiatan'),
                Tables\Columns\TextColumn::make('tanggal_mulai')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('tanggal_selesai')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('lokasi')
                    ->searchable(),
                Tables\Columns\TextColumn::make('status'),
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
            StrukturOrganisasiMakrabsRelationManager::class,
            PesertaMakrabRelationManager::class,
         ];
    }

    public static function getPages(): array
    {
        return [
            'index'  => Pages\ListMakrabs::route('/'),
            'create' => Pages\CreateMakrab::route('/create'),
            'view'   => Pages\ViewMakrab::route('/{record}'),
            'edit'   => Pages\EditMakrab::route('/{record}/edit'),
         ];
    }
}