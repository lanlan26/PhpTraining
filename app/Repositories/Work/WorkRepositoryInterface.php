<?php
namespace App\Repositories\Work;

interface WorkRepositoryInterface
{
    public function create(array $attributes);

    public function updateWork($id,array $attributes);

    public function delete($id);

}
