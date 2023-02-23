<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\PermissionService;
use App\Services\RoleService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class RoleController extends Controller
{
    protected $roleService;
    protected $permissionService;

    public function __construct(
        RoleService $roleService,
        PermissionService $permissionService
    ) {
        $this->roleService = $roleService;
        $this->permissionService = $permissionService;
    }

    public function index() {
        $roles = $this->roleService->getAllRole();
        return view('admin.role.index', compact('roles'));
    }
    
    public function getFormEdit(int $id) {
        $permissions = $this->permissionService->getAllParentPermission();
        $role = $this->roleService->getRoleById($id);
        $role_permissions = $this->roleService->getListIdPermissonFromRoleRelation($role);
        return view('admin.role.edit', compact('permissions', 'role', 'role_permissions'));
    }

    public function create() {
        $permissions = $this->permissionService->getAllParentPermission();
        return view('admin.role.add', compact('permissions'));
    }

    public function update(Request $request, $id)
    {
        $response = $this->roleService->updateRole($request, $id);
        if ($response['success']) {
            return redirect()->back()->with('success_msg', $response['message']);
        }
        return redirect()->back()->with('error_msg', $response['message']);
    }

    public function store(Request $request)
    {
        $response = $this->roleService->store($request);
        if ($response['success']) {
            return redirect()->back()->with('success_msg', $response['message']);
        }
        return redirect()->back()->with('error_msg', $response['message']);
    }

    public function destroy($id)
    {
        $response = $this->roleService->delete($id);
        if ($response['success']) {
            return redirect()->back()->with('success_msg', $response['message']);
        }
        return redirect()->back()->with('error_msg', $response['message']);
    }
}


