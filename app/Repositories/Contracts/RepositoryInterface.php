<?php

namespace App\Repositories\Contracts;

interface RepositoryInterface
{
    public function all($columns = ['*']);

    public function paginate($limit = null, $columns = ['*']);

    public function findOrFail($id, $columns = ['*']);

    public function findByField($field, $value);

    public function find($id);

    public function create(array $attributes);

    public function update(array $attributes);

    public function delete();

    public function destroy($id);

    public function orderBy($column, $direction = 'asc');

    public function with($relations);

    public function where($column, $operator = null, $condition = null);

    public function whereIn($olumn, $values);

    public function take($number);

    public function count();

    public function get($columns = ['*']);

    public function sum($column);

    public function firstOrFail();

    public function pluck($column);

    public function multiCreate($input);

    public function whereNotIn($column, $values);

    public function restore();
}
