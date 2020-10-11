<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Work extends Model
{
    protected $table = 'works';

    protected $fillable = [
        'title',
        'slug',
        'image',
        'skill',
        'excerpt',
        'body',
        'active',
        'created_by',
    ];
    public function getSearch()
    {
        return ['title', 'slug'];
    }
}
