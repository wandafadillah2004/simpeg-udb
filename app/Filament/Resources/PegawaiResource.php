<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PegawaiResource\Pages;
use App\Filament\Resources\PegawaiResource\RelationManagers;
use App\Models\Pegawai;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Closure;

class PegawaiResource extends Resource
{
    protected static ?string $model = Pegawai::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('nip')
                    ->required()
                    ->maxLength(20),
                Forms\Components\TextInput::make('nama')
                    ->required()
                    ->maxLength(100),
                Forms\Components\TextInput::make('tempat_lahir')
                    ->required()
                    ->maxLength(100),
                Forms\Components\DatePicker::make('tanggal_lahir')
                    ->required(),
                Forms\Components\TextInput::make('telp')
                    ->tel()
                    ->required()
                    ->maxLength(50),
                Forms\Components\TextInput::make('email')
                    ->email()
                    ->required()
                    ->maxLength(100),
                //Forms\Components\TextInput::make('kategori_pegawai')
                    //->required()
                    //->maxLength(10),
                Forms\Components\Radio::make('kategori_pegawai')
                    ->required()
                    ->default('Dosen')
                    ->options([
                        'Dosen' => 'Dosen',
                        'Tendik' => 'Tendik',
                    ])
                    ->reactive()
                    ->afterStateUpdated(function (Closure $set, $state) {
                        if ($state=="Tendik") {
                            $set('nidn','');
                        }
                    }),
                //Forms\Components\TextInput::make('nidn')
                    //->required()
                    //->maxLength(15),
                Forms\Components\TextInput::make('nidn')
                    ->maxLength(15)
                    ->required(function (Closure $get) {
                        return $get('kategori_pegawai') == "Dosen";
                    })
                    ->hidden(function (Closure $get) {
                        return $get('kategori_pegawai') == "Tendik";
                    }),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nip'),
                Tables\Columns\TextColumn::make('nama'),
                Tables\Columns\TextColumn::make('tempat_lahir'),
                Tables\Columns\TextColumn::make('tanggal_lahir')
                    ->date(),
                Tables\Columns\TextColumn::make('telp'),
                Tables\Columns\TextColumn::make('email'),
                Tables\Columns\TextColumn::make('kategori_pegawai'),
                Tables\Columns\TextColumn::make('nidn'),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime(),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime(),
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
            'index' => Pages\ListPegawais::route('/'),
            'create' => Pages\CreatePegawai::route('/create'),
            'edit' => Pages\EditPegawai::route('/{record}/edit'),
        ];
    }    
}
