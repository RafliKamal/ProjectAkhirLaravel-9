<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    // Specify that 'user_id' is the primary key
    protected $primaryKey = 'user_id';

    // Indicate that the primary key is not an incrementing integer
    public $incrementing = false;

    // Specify the type of the primary key
    protected $keyType = 'string';

    // Add this line
    protected $role;

    public function matkul()
    {
        return $this->hasMany(tbMatkul::class);
    }

    public function hasRole($role)
    {
        return $this->role === $role;
    }

    public function prodi()
    {
        return $this->belongsTo(tbProdi::class, 'prodi_id', 'prodi_id');
    }

    protected $fillable = [
        'user_id',
        'name',
        'email',
        'prodi_id',
        'semester',
        'password',
        'role',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}


class CreateUsersTable extends Migration
{
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->string('user_id')->primary();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('role');
            $table->timestamps();
            $table->rememberToken();
        });
    }

    public function down()
    {
        Schema::dropIfExists('users');
    }
}
// class Users extends Model
// {
//     use HasFactory;

//     protected $table = "users";
//     protected $primaryKey = "user_id";
//     protected $fillable = [
//         'user_id',
//         'name',
//         'email',
//         'password',
//         'role',
//     ];

//     protected $casts = [
//         'prodi_id' => 'string',
//     ];
    
   
// }