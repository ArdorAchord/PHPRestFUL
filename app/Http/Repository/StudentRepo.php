<?php

namespace App\Http\Repository;

use App\Student;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class StudentRepo
{
    function __construct(
        Student $student
    ) {
        $this->student = $student;
    }

    public function create($target)
    {
        $student = Student::create($target);
        return $student;
    }
    public function getByID($id)
    {
        return $this->student->find($id);
    }   

    public function delete($target)
    {
        $target->delete();
        return NULL;
    }

}
