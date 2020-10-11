<?php
namespace App\Repositories;

abstract class EloquentRepository implements RepositoryInterface
{
    /**
     * @var \Illuminate\Database\Eloquent\Model
     */
    protected $_model;

    /**
     * EloquentRepository constructor.
     */
    public function __construct()
    {
        $this->setModel();
    }

    /**
     * get model
     * @return string
     */
    abstract public function getModel();

    /**
     * Set model
     */

    public function search($data)
    {
        if(array_key_exists('keyword', $data)){
            $keyword = $data['keyword'];
            $attributes = $this->_model->getSearch();
            $query = $this->_model;
                foreach($attributes as $attribute){
                    $query = $query->orWhere($attribute, 'like','%'.$keyword.'%');
                }
            return $query;
        }
        return $this->_model;
    }

    public function paging($data)
    {
        array_key_exists('pagesize',$data) ? $pagesize = $data['pagesize'] : $pagesize = 5;
        if(array_key_exists('field', $data) && $data['field'] != ''){
            $field = $data['field'];
            $type = $data['type'];
            $result = $this->search($data)->orderBy($field,$type)->paginate($pagesize);
        }else{
            $result = $this->search($data)->paginate($pagesize);    
        }
        return $result;
    }

    public function setModel()
    {
        $this->_model = app()->make(
            $this->getModel()
        );
    }

    /**
     * Get All
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function getAll()
    {
        return $this->_model->all();
    }

    /**
     * Get one
     * @param $id
     * @return mixed
     */
    public function find($id)
    {
        $result = $this->_model->find($id);
        return $result;
    }

    /**
     * Create
     * @param array $attributes
     * @return mixed
     */
    public function create(array $attributes)
    {
        return $this->_model->create($attributes);
    }

    /**
     * Update
     * @param $id
     * @param array $attributes
     * @return bool|mixed
     */
    public function update($id, array $attributes)
    {
        $result = $this->find($id);
        if($result) {
            $result->update($attributes);
            return $result;
        }
        return false;
    }

    /**
     * Delete
     *
     * @param $id
     * @return bool
     */
    public function delete($id)
    {
        $result = $this->find($id);
        if($result) {
            $result->delete();
            return true;
        }

        return false;
    }
}
