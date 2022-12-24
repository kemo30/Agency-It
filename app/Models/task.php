<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class task extends Model
{
    use HasFactory;
    protected $fillable=[
        'name',
        'details',
        'status',
        'employee_id',
        'project_id',
    ];
    public function project(){
        return $this->belongsTo(Project::class,'project_id','id');
    }
    public function user(){
        return $this->belongsTo(user::class,'employee_id','id');
    }
}
