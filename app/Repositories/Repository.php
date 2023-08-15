<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class Repository
{
    protected $model;

    /**
     * get all data order by created at desc
     *
     */
    public function all()
    {
        return $this->model->all();
    }

    /**
     * get all data order by created at desc
     *
     */
    public function getLatest(): Collection
    {
        return $this->model->latest()->get();
    }

    /**
     * store data to db
     *
     * @param array $data
     */
    public function create(array $data)
    {
        return $this->model->create($data);
    }

    /**
     * find data by id
     *
     * @param int $id
     */
    public function find(int $id): ?Model
    {
        return $this->model->find($id);
    }

    /**
     * update data by id
     *
     * @param int $id
     * @param array $data
     */
    public function update(int $id, array $data)
    {
        $model = $this->find($id);
        if ($model) {
            $model->update($data);
            return $model;
        }
        return null;
    }

    /**
     * update or create data by param
     *
     * @param int $id
     * @param array $data
     */
    public function updateOrCreate(array $params, array $data): ?Model
    {
        $model = $this->model->where($params)->first();
        if (!$model) {
            $model = $this->create(array_merge($params, $data));
        } else {
            $model->update($data);
        }
        return $model;
    }

    /**
     * delete data by id
     *
     * @param int $id
     * @return Model, Null
     */
    public function delete(int $id)
    {
        $model = $this->find($id);
        if ($model) {
            return $model->delete();
        }
        return null;
    }
}
