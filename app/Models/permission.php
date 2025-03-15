<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class permission extends Model
{
    use HasFactory;
    protected $table='permissions';
    protected $primaryKey='id';
    protected $fillable=['permission_name','permission_slug'];
}
