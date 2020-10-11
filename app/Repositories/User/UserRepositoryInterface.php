<?php
namespace App\Repositories\User;

interface UserRepositoryInterface
{
    public function create(array $attributes);

    public function update($id,array $attributes);

    public function delete($id);

}