<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\permissions;
use App\Models\Users;



class role extends Model
{
    use HasFactory;
    protected $table= 'roles';
    protected $primaryKey='id';
    protected $fillable = ['role_name','role_slug'];

    public function users()
    {
        return $this->belongsToMany(User::class,'user_id','id');
    }
}
