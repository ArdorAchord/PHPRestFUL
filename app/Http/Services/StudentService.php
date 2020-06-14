<?php

namespace App\Http\Services;

use App\Http\Repository\StudentRepo;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class StudentService
{
    function __construct(
        StudentRepo $studentRepo
    ) {
        $this->studentRepo = $studentRepo;
    }

    public function getStudent($target)
    {
        $student = $this->studentRepo->getByID($request->student_id);
        return $student;
    }

    public function createStudent($target)
    {
        $student = $this->studentRepo->create($target);
        return $student;
    }

    public function destroyStudent(Request $request)
    {
        $target = $this->studentRepo->getByID($request->student_id);
        if(!$target){
            return 'student not exist';
        }
        $this->studentRepo->delete($target);
    }
}
