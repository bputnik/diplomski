<?php

namespace App\Http\Controllers;

use App\Course;
use App\CourseType;
use App\Language;
use App\Level;
use Illuminate\Http\Request;

class CourseController extends Controller
{

    public function show(){
        return view('admin.courses.show',[
            'courses'=> Course::all()
        ]);
    }

    public function create(){
        return view('admin.courses.create',[
            'languages'=>Language::all(),
            'levels'=>Level::all(),
            'courseTypes'=>CourseType::all()
        ]);
    }

    public function store(Request $request){

             $request->validate([
            'name'=>['required', 'min:3'],
            'language'=>['required'],
            'level'=>['required'],
            'course_type'=> ['required'],
            'number_of_lessons' => ['required'],
            'final_exam'=>['required'],
            'price'=>['required']
        ]);

             $inputs = [
                 'name' => $request->name,
                 'language_id'=>$request->language,
                 'level_id'=>$request->level,
                 'course_type_id'=>$request->course_type,
                 'number_of_lessons'=>$request->number_of_lessons,
                 'final_exam'=>$request->final_exam,
                 'price'=>$request->price
             ];


        Course::create($inputs);
        return back();


    }


}
