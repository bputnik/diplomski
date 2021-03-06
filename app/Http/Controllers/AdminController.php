<?php

namespace App\Http\Controllers;

use App\Admin;
use Illuminate\Foundation\Auth\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{


    public function index(){

        $studentCount = DB::table('students')->count();
        $groupCount = DB::table('groups')->count();
        $teacherCount = DB::table('teachers')->count();
        $languageCount = DB::table('languages')->count();
        $courseCount = DB::table('courses')->count();


        return view('admin.index',[
            'studentCount'=>$studentCount,
            'groupCount'=>$groupCount,
            'teacherCount'=>$teacherCount,
            'languageCount'=>$languageCount,
            'courseCount'=>$courseCount,
        ]);

    }

    public function show(Admin $admin){

        return view('admin.admin-profile', [
            'admin'=>$admin
        ]);

    }

    public function update(Admin $admin) {

       $inputs = request()->validate([

            'name'=> ['required', 'string', 'max:30', 'alpha-dash'],
            'surname'=> ['required', 'string', 'max:30', 'alpha-dash'],
            'email'=>['required', 'email', 'max:255'],
            'avatar' => ['image:jpg, png, jpeg'],

        ]);

        if(request('avatar')) {
           $inputs['avatar'] = request('avatar')->store('images');
        }

        if(request('password') && request('confirm-password')){
            request()->validate([
                'password' => 'min:6|max:255',
                'confirm-password' => 'min:6|max:255',
            ]);
            if(request('password') == request('confirm-password')) {
                $inputs['password'] = bcrypt(request('password'));
                session()->flash('password-changed', 'Lozinka je promenjena!');
            } else
            {
                session()->flash('password-not-confirmed', 'Unete lozinke se ne podudaraju!');
                return back();
            }
        }

        $admin->update($inputs);
        return back();


    }


}
