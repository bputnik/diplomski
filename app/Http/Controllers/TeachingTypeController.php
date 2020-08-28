<?php

namespace App\Http\Controllers;

use App\TeachingType;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class TeachingTypeController extends Controller
{


    public function index(){
        return view('admin.teaching-types.index',[
            'teachingTypes' => TeachingType::all(),
        ]);
    }

//    public function create(){
//        return view('admin.teaching-types.create');
//    }

    public function store(Request $request){
        $request->validate([
            'name' => 'required'
        ]);

        $name = $request->input('name');
        $name = Str::lower($name);

        $teachingTypes = TeachingType::all();

        foreach ($teachingTypes as $teachingType)
        {
            if ($name == Str::lower($teachingType->name))
            {
                session()->flash('teaching-type-exist', Str::ucfirst(request('name')) . ' već postoji u bazi.');
                return redirect()->route('admin.teaching-types.index');
            }
        }
        session()->flash('teaching-type-inserted', Str::ucfirst(request('name')) . ' je uspešno dodat u bazu.');
        //  DB::insert('insert into languages (name) values (?)', [$name]);
        TeachingType::create([
            'name'=>$name,
        ]);
        return redirect()->route('admin.teaching-types.index');
    }

    public function edit(TeachingType $teachingType){
        return view('admin.teaching-types.edit', [
            'teachingType'=>$teachingType

        ]);

    }


    public function update(TeachingType $teachingType){

        $teachingType->name = Str::lower(request('name'));


        if($teachingType->isDirty('name'))
        {
            session()->flash('teaching-type-updated', 'Naziv tipa nastave je izmenjen u: ' . request('name'));
            $teachingType->save();
            return redirect()->route('admin.teaching-types.index');

        } else {
            session()->flash('teaching-type-not-updated', 'Nema izmena');
            return back();
        }


    }



    public function destroy(TeachingType $teachingType){


        $teachingType->delete();

        session()->flash('teaching-type-deleted', 'Tip nastave ' . Str::upper($teachingType->name) . ' je obrisan');
        return back();

    }



}
