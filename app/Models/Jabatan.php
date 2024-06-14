<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Jabatan extends Model
{
    protected $primaryKey = 'id';
    protected $keyType = 'integer';
    protected $table ='jabatan';
    
    protected $fillable = [
        'nama_jabatan'
    ];
}