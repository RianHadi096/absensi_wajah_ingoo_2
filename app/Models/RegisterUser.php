<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RegisterUser extends Model
{

    protected $table = 'users';
    protected $primaryKey = 'id';
    protected $fillable = ['id_karyawan','name', 'email', 'password'];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
}
