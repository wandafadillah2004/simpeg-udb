<?php

namespace App\Filament\Resources\RiwayatJabatanResource\Pages;

use App\Filament\Resources\RiwayatJabatanResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListRiwayatJabatans extends ListRecords
{
    protected static string $resource = RiwayatJabatanResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
