<?php

namespace App\Repositories\Eloquent;

use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Container\Container;
use Illuminate\Database\Eloquent\Model;
use App\Repositories\Contracts\RepositoryInterface;
use Illuminate\Database\Eloquent\ModelNotFoundException;

abstract class BaseRepository implements RepositoryInterface
{
    protected $app;
    protected $model;

    public function __construct(Container $app)
    {
        $this->app = $app;
        $this->makeModel();
    }

    abstract public function getModel();

    public function makeModel()
    {
        $model = $this->app->make($this->getModel());

        if (!$model instanceof Model) {
            throw new Exception('Class ' . $this->model() . ' must be an instance of Illuminate\Database\Eloquent\Model');
        }

        return $this->model = $model;
    }

    public function __call($method, $args)
    {
        $model = $this->model;

        if ($method == head($args)) {
            $this->model = call_user_func_array([$model, $method], array_diff($args, [head($args)]));

            return $this;
        }

        if (!$model instanceof Model) {
            $model = $model->first();
            if (!$model) {
                throw new ModelNotFoundException();
            }
        }

        $this->model = call_user_func_array([$model, $method], $args);

        return $this;
    }

    public function resetModel()
    {
        $this->makeModel();
    }
    
    public function all($columns = ['*'])
    {
        return $this->model->all($columns);
    }

    public function paginate($limit = null, $columns = ['*'])
    {
        return $this->model->paginate($limit, $columns);
    }

    public function findOrFail($id, $columns = ['*'])
    {
        $model = $this->model->findOrFail($id, $columns);
        $this->resetModel();

        return $model;
    }

    public function find($id)
    {
        return $this->model->find($id);
    }
    

    public function findByField($field, $value)
    {
        return $this->model->where($field, '=', $value)->get()->first();
    }

    public function create(array $attributes)
    {
        return $this->model->create($attributes);
    }

    public function update($id, array $attributes)
    {
        return $this->model->where('id', $id)->update($attributes);
    }

    public function delete()
    {
        return $this->model->delete();
    }

    public function destroy($id)
    {
        return $this->model->destroy($id);
    }

    public function orderBy($column, $direction = 'asc')
    {
        $this->model = $this->model->orderBy($column, $direction);

        return $this;
    }

    public function with($relations)
    {
        $this->model = $this->model->with($relations);

        return $this;
    }

    public function where($column, $operator = null, $condition = null)
    {
        $this->model = $this->model->where($column, $operator, $condition);

        return $this;
    }

    public function whereIn($column, $values)
    {
        $values = is_array($values) ? $values : [$values];
        $this->model = $this->model->whereIn($column, $values);

        return $this;
    }

    public function take($number)
    {
        $this->model = $this->model->take($number);

        return $this;
    }

    public function count()
    {
        $model = $this->model->count();
        $this->resetModel();

        return $model;
    }

    public function get($columns = ['*'])
    {
        $model = $this->model->get($columns);
        $this->resetModel();

        return $model;
    }

    public function sum($column)
    {
        $model = $this->model->sum($column);
        $this->resetModel();

        return $model;
    }
}
