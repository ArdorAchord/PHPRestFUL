<?php

namespace App\Http\Repository;

use App\Teacher;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TeacherRepo
{
    function __construct (
        Teacher $teacher
    ) {
        $this->teacher = $teacher;
    }

    public function getByID($id)
    {
        return $this->teacher->find($id);
    }

    public function create($target)
    {
        return Teacher::create($target);
    }

    public function delete($target)
    {
        $target->delete();
    }
}