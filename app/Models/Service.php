<?php

namespace App\Models;

use App\Models\Department as ModelsDepartment;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'service_name',
        'service_image'
    ];

    public function user(){
        return  $this -> hasOne(User::class,'id','user_id');
    }

    public function department(){
        return $this -> hasOne(Department::class,'department_image','service_image');
    }
}
