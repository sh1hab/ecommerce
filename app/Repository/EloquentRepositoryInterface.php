<?php


namespace App\Repository;


interface EloquentRepositoryInterface
{
    public function create(array $attributes);

    public function update($id, array $attributes);

    public function delete($id);

    public function find($id);

    public function findOrFail($id);


}