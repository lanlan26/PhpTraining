<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $table = 'posts';
    protected $fillable = [
        'title','slug', 'seo_title', 'excerpt', 'body', 'meta_description', 'keywords'
    ];

    public function getRouteKeyName()
	{
	    return 'slug';
	}

	public function getSearch()
    {
        return ['title', 'slug', 'seo_title', 'excerpt', 'body', 'meta_description', 'keywords'];
    }
}
