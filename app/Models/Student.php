<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $table = 'students';

    protected $primaryKey = 'student_id';

    protected $fillable = [
        'student_name',
        'roll_number',
        'email',
        'phone',
        'gender',
        'date_of_birth',
        'course',
        'semester',
    ];
}
