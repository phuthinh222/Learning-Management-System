<?php

namespace App\Repositories\Contracts;

interface BaseRepositoryInterface 
{
    public function find($id);

    public function create($data);

    public function update($id, $data);

    public function destroy($id);
}