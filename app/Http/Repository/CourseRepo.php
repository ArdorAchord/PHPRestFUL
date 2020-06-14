<?php

namespace App\Http\Repository;

use App\Course;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CourseRepo
{
    function __construct(
        Course $course
    ){
        $this->course = $course;
    }
    
    public function getByID($id)
    {
        return $this->course->find($id);
    }

    public function getByTeacherID($id)
    {
        return $this->course->where('teacher_id', $id);
        
    }

    public function create($target)
    {
        return Course::create($target);
    }

    public function delete($target)
    {
        $target->delete();
        return NULL;
    }

    public function getByFilter(array $param)
    {
        $query = $this->course->query();
        if (isset($param['id'])) {
            $query->find($param['id']);
        }
        return $query->get();
    }

    public function update($request)
    {
        $query = $this->course->query();
        $target = $query->where('id', $request->course_id)->update([
            'teacher_id' => $request->teacher_id
        ]);
        return $query->get();
    }
}