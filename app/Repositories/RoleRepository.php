<?php

namespace App\Repositories;

use App\Models\Role;
use Illuminate\Http\Request;

class RoleRepository extends BaseRepository
{
    public function model()
    {
        return Role::class;
    }

    public function updateRole($request, $id)
    {
        $dataUpdate  = [
            "name" => $request->name,
            "display_name" => $request->display_name,
        ];
        $this->update($id, $dataUpdate);
        return $this->find($id)
            ->permissions()
            ->sync($request->permission_id);
    }
}
