<?php
namespace App\Repositories\Post;

use App\Repositories\EloquentRepository;

class PostEloquentRepository extends EloquentRepository implements PostRepositoryInterface
{
	public function getModel()
	{
        return \App\Models\Post::class;
	}

	public function create(array $attributes)
	{
		$this->_model->title = $attributes['title'];
        $this->_model->slug = $attributes['slug'];
        $this->_model->seo_title = $attributes['seo_title'];
        $this->_model->excerpt = $attributes['excerpt'];
        $this->_model->body = $attributes['body'];
        $this->_model->meta_description = $attributes['meta_description'];
        $this->_model->keywords = $attributes['keywords'];
        $this->_model->active = 1;
        $this->_model->created_by = $attributes['user_id'];
        return $this->_model->save();
	}

	public function whereSlug($slug)
    {
        $result = $this->_model->where('slug', $slug)->first();
        return $result;
    }

    public function updatePost($id, array $attributes)
    {
        $input = [
            'title' => $attributes['title'],
            'slug' => $attributes['slug'],
            'seo_title' => $attributes['seo_title'],
            'excerpt' => $attributes['excerpt'],
            'body' => $attributes['body'],
            'meta_description' => $attributes['meta_description'],
            'keywords' => $attributes['keywords'],
            'active' => $attributes['active'],
        ];
        return $this->_model->find($id)->update($input);
    }

}
