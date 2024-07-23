<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tbProdi extends Model
{
    use HasFactory;

    protected $table = "tb_prodi";
    protected $primaryKey = "prodi_id";
    protected $fillable = ["prodi_id", "namaProdi", "namaKaprodi"];

    protected $casts = [
        'prodi_id' => 'string',
    ];
    
    public $timestamps = false; // Menonaktifkan timestamps

    public function user()
    {
        return $this->hasMany(User::class);
    }

    public function matkul()
    {
        return $this->hasMany(tbMatkul::class);
    }
}
