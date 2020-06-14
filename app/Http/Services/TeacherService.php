<?php

namespace App\Http\Services;


use App\Http\Repository\TeacherRepo;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TeacherService
{
    function __construct(
        TeacherRepo $teacherRepo
    ) {
        $this->teacherRepo = $teacherRepo;
    }
    
    public function createTeacher($target)
    {
        $teacher = $this->teacherRepo->create($target);
        return $teacher;
    }

    public function destroyTeacher($target)
    {
        $target = $this->teacherRepo->getByID($target['teacher_id']);
        if(!$target){
            return 'teacher not exist';
        }
        $target = $this->teacherRepo->delete($target);
        return $target;
    }
}