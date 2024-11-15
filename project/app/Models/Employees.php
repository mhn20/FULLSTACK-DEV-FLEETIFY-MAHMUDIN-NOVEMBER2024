<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Employees extends Model
{
    protected $table = "employee";

    protected $fillable = [
        'employee_id',
        'departement_id',
        'name', 'address'
    ];

    public $timestamps = true;

    public function departement() {
        return $this->belongsTo('App\Models\Departements');
    }
}
