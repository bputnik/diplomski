<?php

namespace App\Http\Controllers;

use App\OldStudent;
use Illuminate\Http\Request;

class OldStudentController extends Controller
{
    public function show(){

        return view('admin.students.old-students', [
            'oldStudents'=> OldStudent::where('deleted','=', 0)->get()
        ]);
    }

    public function destroy(OldStudent $oldStudent) {

        $oldStudent->deleted = 1;
        $oldStudent->update();
        session()->flash('old-student-deleted', 'Podaci o starom studentu su izbrisani.');
        return back();

    }

}
