<?php
namespace App\Filament\Resources\ModuleKegiatan;

use App\Filament\Resources\ModuleKegiatan\KegiatanAcaraResource\Pages;
use App\Filament\Resources\ModuleKegiatan\KegiatanAcaraResource\RelationManagers\KehadiranKegiatanRelationManager;
use App\Filament\Resources\ModuleKegiatan\KegiatanAcaraResource\RelationManagers\PesertaKegiatanRelationManager;
use App\Filament\Resources\ModuleKegiatan\KegiatanAcaraResource\RelationManagers\RegistrationKegiatanRelationManager;
use App\Filament\Resources\ModuleKegiatan\KegiatanAcaraResource\RelationManagers\StrukturOrganisasiKegiatanRelationManager;
use App\Models\KegiatanAcara;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class KegiatanAcaraResource extends Resource
{
    protected static ?string $model = KegiatanAcara::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationGroup = 'Kegiatan atau Acara';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('nama_kegiatan')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('tahun_kegiatan')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('jenis_kegiatan')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('lokasi')
                    ->label('Lokasi Kegiatan')
                    ->required()
                    ->maxLength(255),
                Forms\Components\DatePicker::make('tanggal_mulai')
                    ->required(),
                Forms\Components\DatePicker::make('tanggal_selesai')
                    ->required(),
                Forms\Components\Select::make('id_mahasiswa')
                    ->label('Ketua Pelaksana')
                    ->relationship('mahasiswa', 'nama')
                    ->searchable()
                    ->preload(),
                Forms\Components\Select::make('status')
                    ->options([
                        'Belum Terlaksana'   => 'Belum Terlaksana',
                        'Sedang Berlangsung' => 'Sedang Berlangsung',
                        'Selesai'            => 'Selesai',
                     ])
                    ->required(),
                Forms\Components\Toggle::make('has_struktur')
                    ->required(),
                Forms\Components\Toggle::make('has_peserta')
                    ->required(),
                Forms\Components\Toggle::make('has_kehadiran')
                    ->required(),
                Forms\Components\Toggle::make('has_registration')
                    ->required(),
                Forms\Components\Textarea::make('deskripsi')
                    ->columnSpanFull()
                    ->maxLength(255),
             ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nama_kegiatan')
                    ->searchable(),
                Tables\Columns\TextColumn::make('tahun_kegiatan')
                    ->searchable(),
                Tables\Columns\TextColumn::make('jenis_kegiatan')
                    ->searchable(),
                Tables\Columns\TextColumn::make('tanggal_mulai')
                    ->dateTime('d-m-Y')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: false),
                Tables\Columns\TextColumn::make('tanggal_selesai')
                    ->dateTime('d-m-Y')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: false),
                Tables\Columns\TextColumn::make('lokasi')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('mahasiswa.nama')
                    ->label('Ketua Pelaksana')
                    ->searchable()
                    ->sortable(),
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
            StrukturOrganisasiKegiatanRelationManager::class,
            PesertaKegiatanRelationManager::class,
            KehadiranKegiatanRelationManager::class,
            RegistrationKegiatanRelationManager::class,
         ];
    }

    public static function getPages(): array
    {
        return [
            'index'  => Pages\ListKegiatanAcaras::route('/'),
            'create' => Pages\CreateKegiatanAcara::route('/create'),
            'view'   => Pages\ViewKegiatanAcara::route('/{record}'),
            'edit'   => Pages\EditKegiatanAcara::route('/{record}/edit'),
         ];
    }
}