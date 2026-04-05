<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */

    protected $table = "user";
    protected $primaryKey = 'id_admin';
    public $incrementing = true;
    protected $keyType = 'int';
    protected $fillable = [
        'nama',
        'email',
        'google_id',
        'role',
        'status',
        'password',
        'hp',
        'foto',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function barangMasuk()
    {
        return $this->hasMany(BarangMasuk::class, 'id_admin', 'id_admin');
    }

    public function barangKeluar()
    {
        return $this->hasMany(BarangKeluar::class, 'id_admin', 'id_admin');
    }

}
