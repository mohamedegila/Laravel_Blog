<?php

namespace App\Repository;

use App\Contract\RepositoryInterface;
use Illuminate\Database\Eloquent\Model;

class BaseRepository implements RepositoryInterface
{
    protected $model = null;
    protected function __construct(Model $model)
    {
        $this->model = $model;
    }

    public function setModel(Model $model)
    {
        $this->model = $model;
    }

    public function all()
    {
        return $this->model->all();
    }
    public function getById($id)
    {
        return $this->model::where('id', $id)->firstOrFail();
    }
    public function update($id, ...$data)
    {
        $this->model= $this->getById($id);
        return $this->model->update(...$data);
    }
    public function create(...$params)
    {
        $this->model->create(...$params);
    }
    public function destroy($id)
    {
        return $this->getById($id)->delete();
    }
}
