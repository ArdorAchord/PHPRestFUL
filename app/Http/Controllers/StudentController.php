<?php

namespace App\Http\Controllers;

use App\Http\Services\StudentService;
use App\Http\Services\StudentCourseMappingService;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class StudentController extends Controller
{
    function __construct(
        StudentService $studentService,
        StudentCourseMappingService $studentCourseMappingService
    ) {
        $this->studentService = $studentService;
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
        $target = $this->studentService->createStudent($target);
        return response($target);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function show(Student $student)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function edit(Student $student)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Sudetnt $student)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {        
        $param = [
            'student_id' => $request->student_id
        ];
        $target = $this->studentService->destroyStudent($request);
        $this->studentCourseMappingService->destroyCourse($param);
        return $target;
    }

    public function courseStore(Request $request)
    {
        $target = $request->only([
            'student_id',
            'course_id',
        ]);
        $target = $this->studentCourseMappingService->createCourse($target);
        return $target;
    }

    public function courseDestroy(Request $request)
    {
        $target = $this->studentCourseMappingService->destroyCourse($request);
        return $target;
    }
}
