<?php
namespace App\Filament\Resources;

use App\Filament\Resources\DokumenSertifikatResource\Pages;
use App\Models\DokumenSertifikat;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Str;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;

class DokumenSertifikatResource extends Resource
{
    protected static ?string $model = DokumenSertifikat::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationGroup = 'Master Data';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('nama_dokumen')
                    ->required()
                    ->columnSpanFull()
                    ->maxLength(255),
                Forms\Components\Select::make('jenis_dokumen')
                    ->options([
                        'sertifikat' => 'Sertifikat',
                        'piagam'     => 'Piagam',
                        'lainnya'    => 'Lainnya',
                     ])
                    ->required(),
                Forms\Components\Select::make('jenis_kegiatan')
                    ->options([
                        'pkkmb'       => 'PKKMB',
                        'mabim'       => 'MABIM',
                        'makrab'      => 'Makrab',
                        'kepanitiaan' => 'Kepanitiaan',
                        'seminar'     => 'Seminar',
                        'workshop'    => 'Workshop',
                        'pelatihan'   => 'Pelatihan',
                        'lainnya'     => 'Lainnya',
                     ])
                    ->required(),
                Forms\Components\FileUpload::make('file')
                    ->disk('public')
                    ->directory('dokumen-sertifikat')
                    ->getUploadedFileNameForStorageUsing(
                        fn(TemporaryUploadedFile $file): string => (string) str(Str::random() . '.' . $file->getClientOriginalExtension())
                            ->prepend('dokumen-sertifikat-'),
                    )
                    ->acceptedFileTypes([ 'application/vnd.openxmlformats-officedocument.wordprocessingml.document', 'application/vnd.oasis.opendocument.text', 'application/vnd.oasis.opendocument.text-template', 'application/rtf', 'application/msword' ])
                    ->maxSize(1024)
                    ->downloadable()
                    ->columnSpanFull()
                    ->required(),
             ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nama_dokumen')
                    ->searchable(),
                Tables\Columns\TextColumn::make('jenis_dokumen'),
                Tables\Columns\TextColumn::make('jenis_kegiatan'),
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
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
             ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                 ]),
             ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageDokumenSertifikats::route('/'),
         ];
    }
}