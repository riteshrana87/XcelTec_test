<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EmployeeMaster extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'employee_master';

    protected $fillable = [
        'department_id',
        'employee_name',
        'employee_work_email',
        'deleted_at',
        'status',
    ];

    public function salary()
    {
        return $this->hasOne(EmployeeSalary::class,'employee_id','id');
    }

    public function department()
    {
        return $this->belongsTo(Department::class, 'department_id');
    }
}
