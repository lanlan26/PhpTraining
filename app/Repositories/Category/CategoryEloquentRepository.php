<?php
namespace App\Repositories\Category;

use App\Repositories\EloquentRepository;

class CategoryEloquentRepository extends EloquentRepository implements CategoryRepositoryInterface
{
    /**
     * get model
     * @return string
     */

    public function getModel()
    {
        return \App\Models\Category::class;
    }

    public function create(array $attributes)
    {
        $this->_model->title = $attributes['title'];
        $this->_model->slug = $attributes['slug'];
        return $this->_model->save();
    }

    public function whereSlug($slug)
    {
        $result = $this->_model->where('slug', $slug)->first();
        return $result;
    }

    public function update($slug, array $attributes)
    {
        $result = $this->whereSlug($slug);
        if($result){
            $result->title = $attributes['title'];
            $result->slug = $attributes['slug'];
            $result->save();
            return $result;
        }
        return false;
    }

    public function delete($slug)
    {
        $result = $this->whereSlug($slug);
        if($result) {
            $result->delete();
            return true;
        }

        return false;
    }
}
