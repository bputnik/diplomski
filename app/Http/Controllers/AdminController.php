<?php

namespace App\Http\Controllers;

use App\Admin;
use Illuminate\Foundation\Auth\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{

    public function show(Admin $admin){

        return view('admin.admin-profile', [
            'admin'=>$admin
        ]);

    }

    public function update(Admin $admin) {

        $inputs = request()->validate([

            'name'=> ['required', 'string', 'max:30', 'alpha-dash'],
            'surname'=> ['required', 'string', 'max:30', 'alpha-dash'],
            'email'=>['required', 'email', 'max:255' ],
            'password'=> ['min:6', 'max:255', 'confirmed'],
            'avatar'=>['file: jpg, jpeg, png'],
        ]);

        if(request('avatar')) {
            $inputs['avatar'] = request('avatar')->store('images');
        }

        $admin->update($inputs);


    }


}
