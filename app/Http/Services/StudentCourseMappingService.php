<?php

namespace App\Http\Services;

use Illuminate\Http\Request;
use App\Http\Repository\StudentRepo;
use App\Http\Repository\CourseRepo;
use App\Http\Repository\StudentCourseMappingRepo;
use Symfony\Component\HttpFoundation\Response;

class StudentCourseMappingService
{
    function __construct(
        StudentRepo $studentRepo,
        CourseRepo $courseRepo,
        StudentCourseMappingRepo $studentCourseMappingRepo
    ) {
        $this->studentRepo = $studentRepo;
        $this->courseRepo = $courseRepo;
        $this->studentCourseMappingRepo = $studentCourseMappingRepo;
    }

    function getList($target)
    {
        $courseTarget = $this->courseRepo->getByID($target['course_id']);
        if(!$courseTarget){
            return 'course not exist';
        }
        $studentTargets = $this->studentCourseMappingRepo->getByFilter($target);
        if($studentTargets->get()->isEmpty()){
            return 'no students';
        }
        foreach ($studentTargets->get() as $studentTarget) {
            $target = $target.$this->studentRepo->getByID($studentTarget->student_id);
        }
        return $target;
    }

    function createCourse($target)
    {
        $studentTarget = $this->studentRepo->getByID($target['student_id']);
        if(!$studentTarget){
            return 'student not exist';
        }
        $courseTarget = $this->courseRepo->getByID($target['course_id']);
        if(!$courseTarget){
            return 'course not exist';
        }
        $listTarget = $this->studentCourseMappingRepo->getByFilter($target);
        if(!$listTarget->get()->isEmpty()){
            return 'already exist';
        }
        $target = $this->studentCourseMappingRepo->create($target);
        return $target;
    }

    function destroyCourse($target)
    {
        $target = $this->studentCourseMappingRepo->getByFilter($target);
        if($target->get()->isEmpty()){
            return 'not exist';
        }
        $this->studentCourseMappingRepo->delete($target);
    }
}