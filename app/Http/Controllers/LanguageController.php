<?php

namespace App\Http\Controllers;

use App\Language;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LanguageController extends Controller
{

    public function index(){


    }


    public function create(){}


    public function store(Request $request){

        // $this->authorize('create', Language::class);
        $name = $request->input('name');

      // DB::insert('insert into languages (name) values (?)', [$name]);

       dd($name);

    }



}
