<?php

namespace App\Repositories;

use App\TCategoryType;

class TCategoryTypeRepository  {
  
    protected $post;

    public function __construct(TCategoryType $model) {
      $this->model = $model;
    }

    public function find($id) {
      return $this->model->find($id, ['id', 'description', 'status', 'slug']);
    }

    public function create($attributes) {
      return $this->model->create($attributes);
    }

    public function update($id, array $attributes) {
      return $this->model->find($id)->update($attributes);
    }
  
    public function all($perPage) {
      return $this->model->query()->select(['id', 'description', 'status', 'slug'])->paginate($perPage);
    }

    public function getList() {
      return $this->model->query()->select(['id', 'description', 'status', 'slug'])->get();
    }

    public function delete($id) {
     return $this->model->find($id)->delete();
    }

    public function checkRecord($name)
    {
      $data = $this->model->where('description', $name)->first();
      if ($data) {
        return true;
      }
      return false; 
    }

        /**
     * get banks by query params
     * @param  object $queryFilter
    */
    public function search($queryFilter) {
      $search;
      if($queryFilter->query('term') === null) {
        $search = $this->model->all();  
      } else {
        $search = $this->model->where('description', 'like', '%'.$queryFilter->query('term').'%')->paginate($queryFilter->query('perPage'));
      }
     return $search;
    }
}