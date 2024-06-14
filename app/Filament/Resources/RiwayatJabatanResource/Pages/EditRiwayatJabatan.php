<?php

namespace App\Filament\Resources\RiwayatJabatanResource\Pages;

use App\Filament\Resources\RiwayatJabatanResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;
use App\Models\RiwayatJabatan;

class EditRiwayatJabatan extends EditRecord
{
    protected static string $resource = RiwayatJabatanResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function handleRecordUpdate($record, array $data): RiwayatJabatan
    {
        $data['id'] = $data['tahun']."-".$data['nip_pegawai']."-".$data['id_jabatan'];
        $record->update($data);
        return $record;
    }
}
