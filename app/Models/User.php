<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $table = 'users';
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'valid',
        'confirmed',
        'confirmed_code',
    ];

    public function getSearch()
    {
        return ['name', 'email', 'role'];
    }

}
