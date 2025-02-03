<?php
namespace App\Filament\Resources\ModuleMabim;

use App\Filament\Resources\ModuleMabim\MabimResource\Pages;
use App\Filament\Resources\ModuleMabim\MabimResource\RelationManagers;
use App\Models\Mabim;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class MabimResource extends Resource
{
    protected static ?string $model = Mabim::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationGroup = 'Kegiatan Mabim';

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
        $year_angkatan = [  ];
        for ($i = 2021; $i <= date('Y'); $i++) {
            $year_angkatan[ $i ] = $i;
        }
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nama_kegiatan')
                ->wrap()    
                ->searchable(),
                Tables\Columns\TextColumn::make('tahun_kegiatan'),
                Tables\Columns\TextColumn::make('tanggal_mulai')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('tanggal_selesai')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('lokasi')
                    ->wrap()
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->searchable(),
                Tables\Columns\TextColumn::make('mahasiswa.nama')
                ->wrap()    
                ->label('Ketua Pelaksana')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('status')
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->sortable(),
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
                Tables\Filters\SelectFilter::make('tahun_kegiatan')
                    ->options($year_angkatan),
             ])
            ->actions([
                Tables\Actions\ActionGroup::make([
                    Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                ])
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
            RelationManagers\KehadiranMabimRelationManager::class,
            RelationManagers\PesertaMabimRelationManager::class,
         ];
    }

    public static function getPages(): array
    {
        return [
            'index'  => Pages\ListMabims::route('/'),
            'create' => Pages\CreateMabim::route('/create'),
            'view'   => Pages\ViewMabim::route('/{record}'),
            'edit'   => Pages\EditMabim::route('/{record}/edit'),
         ];
    }
}