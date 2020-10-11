<?php
namespace App\Repositories\Work;

use App\Repositories\EloquentRepository;
use App\Models\Work;
use Exception;
use File;
use App\Helpers\SetFile;
use DB;
use Illuminate\Support\Facades\Auth;

class WorkEloquentRepository extends EloquentRepository implements WorkRepositoryInterface
{
    /**
     * get model
     * @return string
     */

    public function getModel()
    {
        return \App\Models\Work::class;
    }

    public function create(array $attributes)
    {
        $input = [
            'active' => $attributes['active'],
            'body' => $attributes['body'],
            'title' => $attributes['title'],
            'slug' => $attributes['slug'],
            'skill' => $attributes['skill'],
            'created_by' => Auth::user()->id,
            'excerpt' => $attributes['excerpt'],
        ];
        $nameImageWork = SetFile::uploadImageWork($attributes);
        $input['image'] = isset($nameImageWork) ? $nameImageWork : config('filesystems.image_work_default');
        return $work = $this->_model->create($input);
    }

    public function updateWork($id, array $attributes)
    {
        $input = [
            'active' => $attributes['active'],
            'body' => $attributes['body'],
            'title' => $attributes['title'],
            'slug' => $attributes['slug'],
            'skill' => $attributes['skill'],
            'created_by' => Auth::user()->id,
            'excerpt' => $attributes['excerpt'],
        ];

        $nameImageWork = SetFile::uploadImageWork($attributes);
        $input['image'] = isset($nameImageWork) ? $nameImageWork : $attributes['current_img'];

        if ($attributes['current_img'] != config('filesystems.image_work_default') && isset($nameImageWork)) {
            file::delete(config('filesystems.image_work_path') . $attributes['current_img']);
        }

        return $this->_model->find($id)->update($input);
    }

    public function delete($id)
    {
        $work = $this->_model->find($id);
        DB::beginTransaction();
        try {
            if ($work['image'] != config('filesystems.image_work_default')) {
                file::delete(config('filesystems.image_work_path') . $work['image']);
            }
            $data = $this->_model->destroy($id);
            if (!$data) {
                throw new Exception($data);
            }
            DB::commit();

            return true;
        } catch (Exception $e) {
            DB::rollBack();
            throw $e;

            return false;
        }
    }

}
