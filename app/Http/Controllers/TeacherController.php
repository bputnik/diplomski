<?php

namespace App\Http\Controllers;

use App\Language;
use Illuminate\Http\Request;

class TeacherController extends Controller
{

    public function index(){

        $languages = Language::pluck('name', 'id');

        return view('admin.teachers.create', compact('languages'));
    }



    public static function generatePassword(){

        $permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyz';
        // Output: 54esmdr0qf

        $password = substr(str_shuffle($permitted_chars), 0, 10);
        return $password;

    }


}
