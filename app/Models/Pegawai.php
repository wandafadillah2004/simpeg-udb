<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pegawai extends Model
{
    protected $primaryKey = 'nip';
    protected $keyType = 'string';
    protected $table ='pegawai';
    
    protected $fillable = [
        'nip',
        'nama',
        'tempat_lahir',
        'tanggal_lahir',
        'telp',
        'email',
        'kategori_pegawai',
        'nidn',
    ];
}
