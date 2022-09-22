<?php

namespace App\Repository\Eloquent;

use App\Repository\EloquentRepositoryInterface;
use Illuminate\Database\Eloquent\Model;

class BaseRepository implements EloquentRepositoryInterface
{
    public $model;
    public function __construct($model){
        $this->model = $model;
    }
    public function all(){
        return $this->model->all();
    }
    public function getById($id){
        return $this->model->findorFail($id);
    }
    public function store(array $attribute): ?Model{
        return $this->model->save();
    }
    public function update($model){
        $model->updated_at = Carbon::now();
        return $model->save();
    }
    public function destroy($model){
        return $model->delete();
    }
}
