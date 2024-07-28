<?php

namespace App\Repositories\Contracts;

interface  UserRepositoryInterface extends BaseRepositoryInterface
{
    public function getAll();
    
    public function search($search_string);
    
}