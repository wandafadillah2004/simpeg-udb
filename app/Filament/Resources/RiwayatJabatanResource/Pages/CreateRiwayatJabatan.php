<?php

namespace App\Filament\Resources\RiwayatJabatanResource\Pages;

use App\Filament\Resources\RiwayatJabatanResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateRiwayatJabatan extends CreateRecord
{
    protected static string $resource = RiwayatJabatanResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['id'] = $data['tahun']."-".$data['nip_pegawai']."-".$data['id_jabatan'];
    
        return $data;
    }
}
