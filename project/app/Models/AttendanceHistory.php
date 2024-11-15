<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AttendanceHistory extends Model
{
    protected $table = "attendance_history";

    protected $fillable = [
        'employee_id',
        'attendance_id',
        'date_attendance', 'attendance_type', 'description'
    ];

    public $timestamps = true;

    public function employee() {
        return $this->belongsTo('App\Models\Employees','employee_id','employee_id');
    }

    public function attendance() {
        return $this->belongsTo('App\Models\Attendances','attendance_id','attendance_id');
    }
}
