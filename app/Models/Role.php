<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;
    
    protected $guarded = [];

    public function managers()
    {
        return $this->hasMany(Manager::class, 'role', 'id');
    }

    public function permissions()
    {
        return $this->belongsToMany(Permission::class, 'permission_role', 'role_id', 'permission_id');
    }

    public function hasPermission($permissionName)
    {
        return $this->permissions()->where('name', $permissionName)->count() > 0;
    }
}
