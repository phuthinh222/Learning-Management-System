<?php

namespace App\Repositories\Eloquent;
use App\Repositories\Contracts\BaseRepositoryInterface;
use Illuminate\Database\Eloquent\Model;

class BaseRepository implements BaseRepositoryInterface
{
    protected $model;

    public function __construct(Model $model) {
        $this->model = $model;
    }

    public function find($id) 
    {
        return $this->model->findOrFail($id);
    }

    public function create($data)
    {
        return $this->model->create($data);
    }

    public function update($id, $data)
    {
        $model_to_update = $this->model->findOrFail($id);
        $model_to_update->update($data);
    }

    public function destroy($id)
    {
        return $this->model->destroy($id);
    }
}