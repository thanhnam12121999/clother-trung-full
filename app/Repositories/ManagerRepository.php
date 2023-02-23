<?php

namespace App\Repositories;

use App\Models\Manager;

class ManagerRepository extends BaseRepository
{
    public function model()
    {
        return Manager::class;
    }

    public function getAll()
    {
        return $this->all();
    }

    public function getManagerByRole($role)
    {
        return $this->model->where('role', $role)->get();
        
    }
} 