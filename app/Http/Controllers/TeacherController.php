<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Services\TeacherService;
use App\Http\Services\CourseService;
use App\Http\Services\StudentCourseMappingService;
use Symfony\Component\HttpFoundation\Response;

class TeacherController extends Controller
{
    function __construct(
        TeacherService $teacherService,
        CourseService $courseService,
        StudentCourseMappingService $studentCourseMappingService
    ) {
        $this->teacherService = $teacherService;
        $this->courseService = $courseService;
        $this->studentCourseMappingService = $studentCourseMappingService;
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $target = $request->only('');
        $teacher = $this->teacherService->createTeacher($target);
        return $teacher;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Teacher  $teacher
     * @return \Illuminate\Http\Response
     */
    public function show(Teacher $teacher)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Teacher  $teacher
     * @return \Illuminate\Http\Response
     */
    public function edit(Teacher $teacher)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Teacher  $teacher
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Teacher $teacher)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Teacher  $teacher
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $teacherTarget = $this->teacherService->destroyTeacher($request);
        $courseTargets = $this->courseService->destoryCourseByTeacherID($request);
        $courseTargets = $courseTargets->toArray();
        foreach($courseTargets as &$val){
            $val['course_id'] = $val['id'];
            unset($val['id']);
        }
        foreach ($courseTargets as $courseTarget) {
            $this->studentCourseMappingService->destroyCourse($courseTarget);
        }
        return $teacherTarget;
    }
}
