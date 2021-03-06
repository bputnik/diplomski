<?php

namespace App\Http\Controllers;

use App\Level;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Throwable;

class LevelController extends Controller
{

    public function index(){


        return view('admin.levels.index', [
            'levels' => Level::all()->sortBy('label')
        ]);
    }

    public function create(){

        return view('admin.levels.create');
    }

    public function store(Request $request){
//        $request->label = Str::ucfirst(request('name'));
        $request->name = Str::ucfirst(request('name'));


        $request->validate([
            'label' => 'required|min:2|max:7',
            'name' => 'required|min:3|unique:levels',
            'description' => 'nullable|max:500',
        ]);

        $inputLevel = [
            'label'=>$request->get('label'),
            'name' => $request->get('name'),
            'description'=> $request->get('description')
        ];

        Level::create($inputLevel);
        session()->flash('level-added', 'Nivo je uspešno dodat.');
        return redirect()->route('admin.levels.index');

    }

    public function edit(Level $level){

        return view('admin.levels.edit',[
            'level' => $level,
            'levels' => Level::all(),
        ]);

    }

    public function update(Level $level){
        $level->label = Str::ucfirst(request('label'));
        $level->name = Str::ucfirst(request('name'));
        $level->description = Str::ucfirst(request('description'));

        if($level->isDirty('label', 'name', 'description'))
        {
            session()->flash('level-updated', 'Podaci su uspešno izmenjeni.');
            $level->update();
            return redirect()->route('admin.levels.index');

        } else {
            session()->flash('level-not-updated', 'Nema izmena.');
            return back();
        }
    }


    public function destroy(Level $level){
        try {
            $level->delete();
            session()->flash('level-deleted', 'Jezički nivo ' . Str::upper($level->name) . ' je obrisan iz baze!');
            return back();

        } catch (Throwable $e) {
            report($e);

            session()->flash('level-not-deleted', 'Jezički nivo ' . Str::upper($level->name) . ' ne može biti obrisan. Proverite da li postoji kurs ovog nivoa.');

            return back();
        }

    }


}
