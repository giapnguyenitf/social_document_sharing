<?php

namespace App\Repositories\Contracts;

interface RepositoryInterface
{
    public function all($columns = ['*']);

    public function paginate($limit = null, $columns = ['*']);

    public function findOrFail($id, $column = ['*']);

    public function findByField($field, $value, $columns = ['*']);

    public function create(array $attributes);

    public function update($id, array $attributes);

    public function delete();

    public function destroy($id);

    public function orderBy($column, $direction = 'asc');

    public function with($relations);

    public function where($column, $operator, $condition);

    public function whereIn($olumn, $values);

    public function take($number);

    public function count();
    
    public function get($columns = ['*']);
    
}
