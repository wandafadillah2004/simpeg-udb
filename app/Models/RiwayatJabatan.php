<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RiwayatJabatan extends Model
{
    protected $primaryKey = 'id';
    protected $keyType = 'string';
    protected $table ='riwayat_jabatan';
    
    protected $fillable = [
        'id',
        'tahun',
        'nip_pegawai',
        'id_jabatan',
        'tgl_mulai',
        'tgl_sampai',
    ];
    
    //relasi tabel
    public function pegawai()
    {
        return $this->belongsTo(
            Pegawai::class,
            "nip_pegawai",
            "nip"
        );
    }
    
    public function jabatan()
    {
        return $this->belongsTo(
            Jabatan::class,
            "id_jabatan",
            "id"
        );
    }
}