<?php

namespace App\Http\Controllers;

//use Barryvdh\DomPDF\PDF;
use App\Payment;
use App\Student;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PDFController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function generatePDF(Student $student)
    {

      //  dd($student->id);

        $payments = Payment::all()->where('student_id', '=', $student->id);

        //dd($payments);

        $studenti = DB::select('select * from students where id=?',[$student->id]);

        $courses = DB::select('select * from courses where id in (select course_id from payments where student_id=?)', [$student->id]);

        $uplate = 0;

        $groups_students = DB::select('select * from group_student where student_id=?', [$student->id]);

        $groups = DB::select('select * from `groups` where id in (select group_id from group_student where student_id=?)', [$student->id]);
        // dd($groups);

        $serbianLatinSmall = ['č', 'ć', 'đ'];
        $latinHTMLcodes = ['&#269;', '&#263;', '&#273;'];

        $data = [
            'payments'=>$payments,
            'student'=> $studenti[0],
            'courses'=> $courses,
            'uplate'=> $uplate,
            'groups_students'=>$groups_students,
            'groups'=>$groups,
        ];






        $pdf = PDF::loadView('admin.payments.generate-pdf', $data);


        $imeFajla = 'izvestaj_' . $studenti[0]->name . '_' . $studenti[0]->surname . '_' . date('d-m-Y') . '.pdf';
        return $pdf->download($imeFajla);
    }
}
