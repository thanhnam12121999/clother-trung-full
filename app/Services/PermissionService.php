<?php

namespace App\Services;

use App\Repositories\PermissionRepository;
use App\Repositories\RoleRepository;

class PermissionService extends BaseService
{
    protected $permissionRepository;
    
    public function __construct(
        PermissionRepository $permissionRepository
    ) {
       $this->permissionRepository = $permissionRepository;
    }

    public function getAllParentPermission()
    {
        return $this->permissionRepository->getAllParentPermission();
    }
}