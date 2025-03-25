<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

use App\Models\role;

class UserRole extends Model
{
    use HasFactory;
    protected $table='role_user';
    protected $primaryKey='id';
    protected $fillable = ['user_id','role_id'];

    public function ScopegetRoles($query,$user_id){
        return $query->where('user_id',$user_id)->pluck('role_id')->toArray();
    }
}
