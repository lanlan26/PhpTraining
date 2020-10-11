<?php
namespace App\Repositories\Contact;

use App\Repositories\EloquentRepository;

class ContactEloquentRepository extends EloquentRepository implements ContactRepositoryInterface
{
    /**
     * get model
     * @return string
     */

    public function getModel()
    {
        return \App\Models\Contact::class;
    }

    public function getContact($id)
    {
        $result = $this->_model->where('id', $id)->first();
        return $result;
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