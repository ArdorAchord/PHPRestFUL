<?php

namespace App\Http\Repository;

use App\StudentCourseMapping;

class StudentCourseMappingRepo
{
    function __construct(
        StudentCourseMapping $studentCourseMapping
    ) {
        $this->studentCourseMapping = $studentCourseMapping;
    }

    public function create($target)
    {
        $list = StudentCourseMapping::create($target);
        return $list;
    }

    public function delete($target)
    {
        $target->delete();
    }

    public function getByFilter($param)
    {
        $query = $this->studentCourseMapping->query();
        if (isset($param['student_id'])) {
            $query->where('student_id', $param['student_id']);
        }
        if (isset($param['course_id'])) {
            $query->where('course_id', $param['course_id']);
        }
        return $query;
    }
}