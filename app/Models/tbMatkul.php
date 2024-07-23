<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tbMatkul extends Model
{
    use HasFactory;
    protected $table = "tb_matkul";
    protected $primaryKey = "matkul_id";
    protected $fillable = ["matkul_id", "user_id", "prodi_id", "namaMatkul", "semester"];

    protected $casts = [
        'matkul_id' => 'string',
    ];

    public $timestamps = false; // Menonaktifkan timestamps

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }

    public function prodi()
    {
        return $this->belongsTo(tbProdi::class, 'prodi_id', 'prodi_id');
    }
    public function ujian()
    {
        return $this->hasMany(tbUjian::class);
    }
    public function soal()
    {
        return $this->hasMany(tbSoal::class);
    }
}
