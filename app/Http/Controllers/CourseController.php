<?php

namespace App\Http\Controllers;

use App\Course;
use App\CourseType;
use App\Language;
use App\Level;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Throwable;

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
        session()->flash('course-inserted', 'Kurs' . Str::ucfirst(request('name')) . ' je uspešno dodat u bazu.');

        return redirect()->route('admin.courses.show');
    }


    public function edit(Course $course){

        return view('admin.courses.edit',[
            'course'=>$course,
            'languages' => Language::all(),
            'levels'=>Level::all(),
            'courseTypes'=>CourseType::all()
        ]);
    }

    public function update(Course $course){

        $inputs= \request()->validate([
            'name'=>'required',
            'language_id'=>'required',
            'level_id'=>'required',
            'course_type_id'=>'required',
            'number_of_lessons'=>'required',
            'final_exam'=>'required',
            'price'=>'required'
        ]);


        $course->name = Str::ucfirst(\request('name'));
        $course->language_id = $inputs['language_id'];
        $course->level_id = $inputs['level_id'];
        $course->course_type_id = $inputs['course_type_id'];
        $course->number_of_lessons = $inputs['number_of_lessons'];
        $course->final_exam = $inputs['final_exam'];
        $course->price = $inputs['price'];

        if($course->isDirty())
        {
            session()->flash('course-updated', 'Podaci su uspešno izmenjeni.');
            $course->save();
            return redirect()->route('admin.courses.show');

        } else {
            session()->flash('course-not-updated', 'Nema izmena.');
            return back();
        }
    }


    public function destroy(Course $course){

        try {
            $course->delete();
            session()->flash('course-deleted', 'Kurs ' . Str::ucfirst($course->name) . ' je obrisan iz baze!');
            return back();

        } catch (Throwable $e) {
            report($e);

            session()->flash('course-not-deleted', 'Ne možete obrisati kurs ' . Str::ucfirst($course->name) . '! Proverite da li postoji grupa kojoj je dodeljen ovaj kurs.');
            return back();
        }

    }


}
