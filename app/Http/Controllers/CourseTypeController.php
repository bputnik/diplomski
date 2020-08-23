<?php

namespace App\Http\Controllers;

use App\CourseType;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CourseTypeController extends Controller
{

    public function index(){
        return view('admin.courses.types.index',[
            'courseTypes' => CourseType::all()
        ]);
    }


    public function edit(CourseType $courseType){
        return view('admin.courses.types.edit', [
            'courseType'=>$courseType
        ]);

    }

    public function store(Request $request){
        $request->validate([
            'name' => 'required'
        ]);

        $name = $request->input('name');
        $name = Str::lower($name);

        $courseTypes = CourseType::all();

        foreach ($courseTypes as $courseType)
        {
            if ($name == Str::lower($courseType->name))
            {
                session()->flash('courseType-exist', 'Tip kursa ' . Str::upper(request('name')) . ' već postoji u bazi.');
                return redirect()->route('admin.courses.types.index');
            }
        }
        session()->flash('courseType-inserted', Str::ucfirst(request('name')) . ' je uspešno dodat u bazu.');

        CourseType::create([
            'name'=>$name,
        ]);
        return redirect()->route('admin.courses.types.index');


    }


    public function update(CourseType $courseType){
        $courseType->name = Str::lower(request('name'));


        if($courseType->isDirty('name'))
        {
            session()->flash('courseType-updated', 'Naziv vrste kusra je izmenjen u: ' . request('name'));
            $courseType->save();
            return redirect()->route('admin.courses.types.index');

        } else {
            session()->flash('courseType-not-updated', 'Nema izmena');
            return back();
        }
    }


    public function destroy(CourseType $courseType){
        $courseType->delete();
        session()->flash('courseType-deleted', 'Vrsta kursa ' . Str::upper($courseType->name) . ' je obrisana');
        return back();

    }


}
