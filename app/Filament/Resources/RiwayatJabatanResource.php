<?php

namespace App\Filament\Resources;

use App\Filament\Resources\RiwayatJabatanResource\Pages;
use App\Filament\Resources\RiwayatJabatanResource\RelationManagers;
use App\Models\RiwayatJabatan;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Component\BelongsToSelect;

class RiwayatJabatanResource extends Resource
{
    protected static ?string $model = RiwayatJabatan::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('id')
                ->label("ID (otomatis)")
                ->disabled()
                ->maxLength(50),

                Forms\Components\TextInput::make('tahun')
                    ->required()
                    ->numeric()
                    ->minValue(2022),

                Forms\Components\Select::make('nip_pegawai')
                    ->required()
                    ->label('Pegawai')
                    ->relationship("pegawai","nip")
                    ->getOptionLabelFromRecordUsing( function ($record) {
                        return $record->nama;
                    })
                    ->preload(),

                Forms\Components\Select::make('id_jabatan')
                    ->required()
                    ->label('Jabatan')
                    ->relationship("jabatan","id")
                    ->getOptionLabelFromRecordUsing( function ($record) {
                        return $record->nama_jabatan;
                    })
                    ->preload(),

                Forms\Components\DatePicker::make('tgl_mulai')
                    ->required(),
                Forms\Components\DatePicker::make('tgl_sampai')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id'),
                Tables\Columns\TextColumn::make('tahun'),
                Tables\Columns\TextColumn::make('nip_pegawai'),
                Tables\Columns\TextColumn::make('pegawai.nama'),
                Tables\Columns\TextColumn::make('jabatan.nama_jabatan'),
                Tables\Columns\TextColumn::make('tgl_mulai')
                    ->date(),
                Tables\Columns\TextColumn::make('tgl_sampai')
                    ->date(),
                //Tables\Columns\TextColumn::make('created_at')
                    //->dateTime(),
                //Tables\Columns\TextColumn::make('updated_at')
                    //->dateTime(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }
    
    public static function getRelations(): array
    {
        return [
            //
        ];
    }
    
    public static function getPages(): array
    {
        return [
            'index' => Pages\ListRiwayatJabatans::route('/'),
            'create' => Pages\CreateRiwayatJabatan::route('/create'),
            'edit' => Pages\EditRiwayatJabatan::route('/{record}/edit'),
        ];
    }    
}
