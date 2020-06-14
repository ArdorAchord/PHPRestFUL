<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Services\CourseService;
use App\Http\Services\StudentCourseMappingService;
use Symfony\Component\HttpFoundation\Response;

class CourseController extends Controller
{
    function __construct(
        CourseService $courseService,
        StudentCourseMappingService $studentCourseMappingService
    ) {
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
        $target = $this->courseService->getCourse([]);
        return response($target);
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
        $target = $request->only('teacher_id');
        $course = $this->courseService->createCourse($target);
        return response($course);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $param = [
            'id' => $request->course_id
        ];
        $target = $this->courseService->getCourse($param);
        return response($target);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function edit(Course $course)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $target = $this->courseService->updateCourse($request);
        return $target;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $target = $this->courseService->destoryCourse($request);
        return response($target);
    }

    public function studentShow(Request $request)
    {   
        $target = $this->studentCourseMappingService->getList($request);
        return $target;
    }
}
