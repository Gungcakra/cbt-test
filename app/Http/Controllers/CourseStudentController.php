<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\CourseStudent;
use App\Models\StudentAnswer;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException as ValidationException;

class CourseStudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Course $course)
    {
        $questions = $course->questions()->orderBy('id', 'DESC')->get();
        $totalQuestions = $questions->count();
        $students = $course->students()->orderBy('id', 'DESC')->get();

        foreach($students as $student){
            $studentAnswers = StudentAnswer::whereHas('question', function($query) use ($course){
                $query->where('course_id', $course->id);
            })->where('user_id', $student->id)->get();

            $answerCount = $studentAnswers->count();
            $correctAnswerCount = $studentAnswers->where('answer', 'correct')->count();
            if($answerCount == 0){
                $student->status = 'Not Started';
            } else if($correctAnswerCount < $totalQuestions){
                $student->status = 'Not Passed';
            } else if($correctAnswerCount == $totalQuestions){
                $student->status = 'Passed';
            } 
        }
        return view('admin.students.index',[
            'title' => 'Students',
            'course' => $course,
            'students' => $students,
            'questions' => $questions,
            'totalQuestions' => $totalQuestions,
            
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Course $course)
    {
        $students = $course->students()->orderBy('id', 'DESC')->get();
        return view('admin.students.add_student', [
            'title' => 'Add Student',
            'course' => $course,
            'students' => $students
        ]);
    }
   

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Course $course)
    {
        $request->validate([
            'email' => 'required|string',
        ]);

        $user = User::where('email', $request->email)->first();
        if(!$user){
            $error = ValidationException::withMessages([
                'email' => ['Email Student tidak tersedia!']
            ]);
            throw $error;
        }

        $isEnrolled = $course->students()->where('user_id', $user->id)->exists();

        if($isEnrolled){
            $error = ValidationException::withMessages([
                'email' => ['Student sudah terdaftar di course ini!']
            ]);
            throw $error;
        }

        DB::beginTransaction();

        try {
            $course->students()->attach($user->id);
            DB::commit();
            return redirect()->route('dashboard.course.course_students.index', $course->id)->with('success', 'Student added successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            $error = ValidationException::withMessages([
                'system_error' => ['System error! ' . $e->getMessage()]
            ]);
            throw $error;
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(CourseStudent $courseStudent)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CourseStudent $courseStudent)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, CourseStudent $courseStudent)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CourseStudent $courseStudent)
    {
        //
    }
}
