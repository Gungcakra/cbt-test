<?php

namespace App\Http\Controllers;

use App\Models\CourseQuestion;
use App\Models\StudentAnswer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LearningController extends Controller
{
    //

    public function index()
    {
        $user = Auth::user();
        $myCourses = $user->courses()->with('category')->orderBy('id', 'DESC')->get();

        foreach ($myCourses as $course) {
            $totalQuestionCourse = $course->questions->count();
            $answeredQuestionCourse = StudentAnswer::where('user_id', $user->id)
                ->whereHas('question', function ($query) use ($course) {
                    $query->where('course_id', $course->id);
                })->distinct()->count();

            if ($answeredQuestionCourse < $totalQuestionCourse) {
                $firstUnansweredQuestion = CourseQuestion::where('course_id', $course->id)
                    ->whereNotIn('id', function ($query) use ($user) {
                        $query->select('id')->from('student_answers')
                            ->where('user_id', $user->id);
                    })->orderBy('id', 'ASC')->first();

                $course->nextQuestionId = $firstUnansweredQuestion?->id;
            } else {
                $course->nextQuestionId = null;
            }
        }
        return view('student.index', [
            'myCourses' => $myCourses
        ]);
    }
}
