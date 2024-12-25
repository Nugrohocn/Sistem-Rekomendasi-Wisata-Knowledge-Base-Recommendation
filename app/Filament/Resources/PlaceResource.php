<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Place;
use Filament\Resources\Form;
use Filament\Resources\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Model;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\FileUpload;
use App\Filament\Resources\PlaceResource\Pages;

class PlaceResource extends Resource
{
    protected static ?string $model = Place::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    /**
     * Define form fields
     */
    public static function form(Form $form): Form
    {
        return $form->schema([
            TextInput::make('nama')
                ->label('Nama Tempat')
                ->required(),

            Textarea::make('deskripsi')
                ->label('Deskripsi')
                ->required(),

            TextInput::make('alamat')
                ->label('Alamat')
                ->required(),

            FileUpload::make('foto')
                ->label('Foto')
                ->directory('image')
                ->image()
                ->required(),

            Select::make('kategori_id')
                ->relationship('category', 'nama')
                ->preload()
                ->label('Kategori')
                ->required(),

            Select::make('lokasi_id')
                ->relationship('location', 'nama')
                ->preload()
                ->label('Lokasi')
                ->required(),

            Select::make('rating_id')
                ->relationship('rating', 'rate')
                ->preload()
                ->label('Rating')
                ->required(),


            // Select::make('tiket_id')
            //     ->relationship('ticket', 'harga')
            //     ->preload()
            //     ->label('Tiket')
            //     ->required(),

            Select::make('tiket_id')
                ->options(function () {
                    return \App\Models\Ticket::query()
                        ->selectRaw('MAX(id) as id, harga') // Pilih satu ID untuk setiap harga
                        ->groupBy('harga') // Mengelompokkan berdasarkan harga
                        ->orderBy('harga', 'asc') // Urutkan dari terkecil ke terbesar
                        ->pluck('harga', 'id'); // Ambil harga dan ID
                })
                ->label('Tiket')
                ->required(),





            Select::make('fasilitas')
                ->relationship('fasilitas', 'nama')
                ->multiple()
                ->preload()
                ->label('Fasilitas')
                ->required(),
        ]);
    }

    /**
     * Handle record creation
     */
    public function handleRecordCreation(array $data): Model
    {
        $fasilitas = $data['fasilitas'] ?? [];
        unset($data['fasilitas']);

        $record = static::getModel()::create($data);

        if ($fasilitas) {
            $record->fasilitas()->sync($fasilitas);
        }

        return $record;
    }

    /**
     * Handle record update
     */
    public function handleRecordUpdate(Model $record, array $data): Model
    {
        $fasilitas = $data['fasilitas'] ?? [];
        unset($data['fasilitas']);

        $record->update($data);

        if ($fasilitas) {
            $record->fasilitas()->sync($fasilitas);
        }

        return $record;
    }

    /**
     * Define table columns and actions
     */
    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('no')
                    ->label('No')
                    ->getStateUsing(fn($rowLoop, $record) => $rowLoop->index + 1),
                TextColumn::make('nama')->label('Nama Tempat'),
                TextColumn::make('category.nama')->label('Kategori'),
                TextColumn::make('location.nama')->label('Lokasi'),
                TextColumn::make('rating.rate')->label('Rating'),
                TextColumn::make('tiket.harga')->label('Harga Tiket'),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ])
            ->defaultSort('id', 'asc'); // Tambahkan sorting default
    }

    /**
     * Get resource relations
     */
    public static function getRelations(): array
    {
        return [];
    }

    /**
     * Define resource pages
     */
    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPlaces::route('/'),
            'create' => Pages\CreatePlace::route('/create'),
            'edit' => Pages\EditPlace::route('/{record}/edit'),
        ];
    }
}
