<?php

namespace App\Services;

use App\Repositories\RoleRepository;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class RoleService extends BaseService
{
    protected $roleRepository;
    
    public function __construct(
        RoleRepository $roleRepository
    ) {
       $this->roleRepository = $roleRepository;
    }

    public function getAllRole()
    {
        return $this->roleRepository->all();
    }

    public function getRoleById($id)
    {
        return $this->roleRepository->find($id);
    }

    public function updateRole($request, $id)
    {
        try {
            DB::beginTransaction();
            $this->roleRepository->updateRole($request, $id);
            DB::commit();
            return $this->sendResponse('Vai trò và quyền đã được sửa thành công.');
        } catch (\Exception $e) {
            Log::error($e);
            DB::rollBack();
        }
        return $this->sendError('Có lỗi xảy ra, vui lòng thử lại.');
    }

    public function getListIdPermissonFromRoleRelation($role)
    {
        try {
            $role_permissions = $role->permissions->map(function ($user) {
                return collect($user)->only(['id']);
              })->toArray();
            return array_column($role_permissions, 'id');
        } catch (\Throwable $th) {
            return [];
        }
    }

    public function store($request)
    {
        try {
            DB::beginTransaction();
            $dataStore = [
                'name' => $request->name,
                'display_name' => $request->display_name,
            ];
            $rolePermission = $this->roleRepository->create($dataStore);
            $rolePermission->permissions()->attach($request->permission_id);
            DB::commit();
            return $this->sendResponse('Vai trò đã được thêm thành công.');
        } catch (\Exception $e) {
            Log::error($e);
            DB::rollBack();
        }
        return $this->sendError('Có lỗi xảy ra, vui lòng thử lại.');
    }

    public function delete($id)
    {
        try {
            DB::beginTransaction();
            $this->roleRepository->delete($id);
            DB::commit();
            return $this->sendResponse('Vai trò đã được xóa thành công.');
        } catch (\Exception $e) {
            Log::error($e);
            DB::rollBack();
        }
        return $this->sendError('Có lỗi xảy ra, vui lòng thử lại.');
    }
}
