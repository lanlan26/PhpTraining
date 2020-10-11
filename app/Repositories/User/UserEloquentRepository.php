<?php
namespace App\Repositories\User;

use App\Repositories\EloquentRepository;

class UserEloquentRepository extends EloquentRepository implements UserRepositoryInterface
{
    /**
     * get model
     * @return string
     */

    public function getModel()
    {
        return \App\Models\User::class;
    }

    public function getUser($id)
    {
        $result = $this->_model->where('id', $id)->first();
        return $result;
    }

    public function create(array $attributes)
    {
        $this->_model->name = $attributes['name'];
        $this->_model->email = $attributes['email'];
        $this->_model->password = bcrypt($attributes['password']);
        $this->_model->role = $attributes['role'];
        $this->_model->valid = $attributes['valid'];
        $this->_model->confirmed = 1;
        $this->_model->confirmed_code = 's7g9b6d8bb9ff6n9j8df';

        return $this->_model->save();
    }

    public function update($id, array $attributes)
    {
        $result = $this->getUser($id);
        if($result){
            $result->name = $attributes['name'];
            $result->email = $attributes['email'];
            if(!empty($attributes['password'])) {
                $result->password = bcrypt($attributes['password']);
            }
            $result->role = $attributes['role'];
            $result->valid = $attributes['valid'];
            $result->confirmed = 1;
            $result->confirmed_code = 's7g9b6d8bb9ff6n9j8df';
            return $result->save();
        }
        return false;
    }

    public function delete($id)
    {
        $result = $this->_model->where('id', $id)->first();
        if($result) {
            $result->delete();
            return true;
        }

        return false;
    }
}