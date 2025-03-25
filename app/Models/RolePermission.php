<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RolePermission extends Model
{
    use HasFactory;
    use HasFactory;
    protected $table='permission_role';
    protected $primaryKey='id';
    protected $fillable = ['permission_id','role_id'];

    public function ScopegetPermissions($query,$role_id){
        return $query->where('role_id',$role_id)->pluck('permission_id')->toArray();
    }
}
