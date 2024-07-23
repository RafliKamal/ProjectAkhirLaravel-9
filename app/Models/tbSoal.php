<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tbSoal extends Model
{
    use HasFactory;

    protected $table = "tb_soal";
    protected $primaryKey = "soal_id";
    protected $fillable = ["soal_id", "ujian_id", "matkul_id", "teksSoal", "filePath"];

    protected $casts = [
        'soal_id' => 'string',
    ];
    
    public $timestamps = false; // Menonaktifkan timestamps

    public function matkul()
    {
        return $this->belongsTo(tbMatkul::class, 'matkul_id', 'matkul_id');
        
    }
}
