<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StudentCourseMapping extends Model
{
    protected $fillable = [
        'student_id',
        'course_id',
    ];
}
