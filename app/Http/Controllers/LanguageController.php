<?php

namespace App\Http\Controllers;

use App\Language;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class LanguageController extends Controller
{

    public function index(){

        return view('admin.languages.index', [
            'languages'=>Language::all()
        ]);
    }


    public function create(){}


    public function store(Request $request)
    {
        // $this->authorize('create', Language::class);
        $name = $request->input('name');
        $name = Str::lower($name);

        $request->validate([
            'name' => 'required'
        ]);

        $languages = Language::all();

        foreach ($languages as $language)
        {
            if ($name == Str::lower($language->name))
            {
                session()->flash('language-exist', Str::ucfirst(request('name')) . ' već postoji u bazi.');
                return redirect()->route('admin.languages.index');
            }
        }
                session()->flash('language-inserted', Str::ucfirst(request('name')) . ' je uspešno dodat u bazu.');
                DB::insert('insert into languages (name) values (?)', [$name]);
                return redirect()->route('admin.languages.index');

    }

    public function edit(Language $language){

        return view('admin.languages.edit', [
            'language'=>$language,

        ]);
    }

    public function update(Language $language){

        $language->name = Str::lower(request('name'));


        if($language->isDirty('name'))
        {
            session()->flash('language-updated', 'Naziv jezika je izmenjen u: ' . request('name'));
            $language->save();
            return redirect()->route('admin.languages.index');

        } else {
            session()->flash('language-not-updated', 'Nema izmena');
            return back();
        }


    }

    public function destroy(Language $language){
        $language->delete();
        session()->flash('language-deleted', 'Jezik ' . Str::upper($language->name) . ' je obrisan');
        return back();
    }



}
