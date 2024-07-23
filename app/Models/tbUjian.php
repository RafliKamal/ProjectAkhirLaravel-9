<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tbUjian extends Model
{
    use HasFactory;
    protected $table = "tb_ujian";
    protected $primaryKey = "ujian_id";
    protected $fillable = ["ujian_id", "matkul_id", "tanggalUjian", "tipeSoal", "durasiUjian", "jenisUjian", "sifatUjian", "tahunAkademik", "status", "komentar"];

    protected $casts = [
        'ujian_id' => 'string',
    ];
    
    public $timestamps = false; // Menonaktifkan timestamps
    public function matkul()
    {
        return $this->belongsTo(tbMatkul::class, 'matkul_id', 'matkul_id');
        
    }
    public function soal()
    {
        return $this->hasMany(tbSoal::class, 'ujian_id', 'ujian_id');
    }
}
