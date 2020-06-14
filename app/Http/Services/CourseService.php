<?php

namespace App\Http\Services;

use DB;
use Illuminate\Http\Request;
use App\Http\Repository\CourseRepo;
use App\Http\Repository\TeacherRepo;
use App\Http\Repository\StudentCourseMappingRepo;
use Symfony\Component\HttpFoundation\Response;

class CourseService
{
    function __construct (
        CourseRepo $courseRepo,
        TeacherRepo $teacherRepo,
        StudentCourseMappingRepo $studentCourseMappingRepo
    ) {
        $this->courseRepo = $courseRepo;
        $this->teacherRepo = $teacherRepo;
        $this->studentCourseMappingRepo = $studentCourseMappingRepo;
    }

    public function createCourse($target)
    {
        $teacher = $this->teacherRepo->getByID($target['teacher_id']);
        if (!$teacher) {
            return 'teacher not exist';
        }
        $course = $this->courseRepo->create($target);
        return $course;
    }
    
    public function destoryCourse(Request $request)
    {
        $target = $this->courseRepo->getByID($request->course_id);
        if(!$target){
            return 'course not exist';
        }
        $this->courseRepo->delete($target);
        $target = $this->studentCourseMappingRepo->getByFilter($request);
        $this->studentCourseMappingRepo->delete($target);
    }

    public function destoryCourseByTeacherID(Request $request)
    {
        $target = $this->courseRepo->getByTeacherID($request->teacher_id);
        $courseTarget = $target->get();
        $this->courseRepo->delete($target);
        return $courseTarget;
    }

    public function getCourse($param)
    {
        $target = $this->courseRepo->getByFilter($param);
        if($target->isEmpty()){
            return 'course not exist';
        }
        return $target;
    }

    public function updateCourse(Request $request)
    {
        $teacher = $this->teacherRepo->getByID($request->teacher_id);
        if (!$teacher) {
            return 'teacher not exist';
        }
        $course = $this->courseRepo->getByID($request->course_id);
        if(!$course){
            return 'course not exist';
        }
        $target = $this->courseRepo->update($request);
        return $target;
    }
}