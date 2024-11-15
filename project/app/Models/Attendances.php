<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Attendances extends Model
{
    protected $table = "attendance";

    protected $fillable = [
        'employee_id',
        'attendance_id',
        'clock_in', 'clock_out'
    ];

    public $timestamps = true;
}
