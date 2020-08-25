<?php

namespace App\Http\Controllers;

use App\Trustee;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class TrusteeController extends Controller
{

    public function show(){
        return view('admin.trustees.show',[
            'trustees'=>Trustee::all()
        ]);
    }

    public function store(Request $request){

//        dd($request);

        $request->validate([
            'name'=>['required','min:2', 'max:20'],
            'surname'=>['required','min:2', 'max:20'],
            'email'=>['required','email','unique:trustees'],
            'address'=>['required'],
            'phone'=>['required'],
        ]);

        $inputs = [
            'name'=>$request->get('name'),
            'surname'=>$request->get('surname'),
            'email'=>$request->get('email'),
            'address'=>$request->get('address'),
            'phone'=>$request->get('phone'),

        ];

        session()->flash('trustee-registered', 'Roditelj je uspešno dodat u bazu! Sada ga možete izabrati iz padajuće liste.');
        Trustee::create($inputs);
        return back();


    }

    public function edit(){

    }

    public function destroy(Trustee $trustee){
        $trustee->delete();
        session()->flash('trustee-deleted', 'Roditelj ' . Str::ucfirst(request('name') . ' ' . Str::ucfirst(request('surname')) . ' je obrisan iz baze!'));
        return back();
    }

}
