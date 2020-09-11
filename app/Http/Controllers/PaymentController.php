<?php

namespace App\Http\Controllers;

use App\Course;
use App\Group;
use App\Payment;
use App\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use mysql_xdevapi\Exception;

class PaymentController extends Controller
{

    public function show(){


        return view('admin.payments.show',[
            'payments'=>Payment::all()
        ]);

    }

    public  function create(){

        return view('admin.payments.create',[
            'students'=>Student::all(),
            'payments'=>Payment::all()
        ]);

    }

//    public function chooseStudent(Request $request){
//
//        $studentId = $request->get('student_id');
//        $student = Student::find($studentId);
//
//        $groups =[];
//        foreach($student->groups as $group) {
//             array_push($groups, $group->pivot->group_id);
//        }
//
//        return view('admin.payments.create',[
//            'groups'=>$groups,
//            'students' => Student::all()
//        ]);
//
//
//    }

    public function store(Request $request){

       // dd($request);

        $request->validate([
            'student_id'=>['required'],
            'groups'=>['required'],
            'payment'=>['required'],
            'payment_method'=>['required'],
        ]);

        $courseID = DB::select('select course_id from groups where id=?', [$request->get('groups')]);


        //$paymentMethod = '';

        if($request->get('payment_method') == 0) {
            $paymentMethod = 'uplata na račun';
        } else {
            $paymentMethod = 'gotovinska uplata';
        }


        $inputPayment = [
            'student_id'=>$request->get('student_id'),
            'course_id'=> $courseID[0]->course_id,
            'amount'=>$request->get('payment'),
            'payment_method'=> $paymentMethod,

        ];

        Payment::create($inputPayment);



        session()->flash('payment-added', 'Uplata je uspešno izvršena.');
        return redirect()->route('admin.payments.show', [
            'payments'=>Payment::all()
        ]);
    }



    public function ajaxGetGroups(Request $request){

        $studentID = $request->izbor;
//        $student = DB::table('group_student')->where('student_id', '=', $studentID)->get();

//        $groupsID = DB::select('select group_id from group_student where student_id=?', [$studentID]);
//
        $groups = DB::select('select * from groups where id in (select group_id from group_student where student_id=?)', [$studentID]);

        //$courses = DB::select('select * from courses where id in (select course_id from groups where id in (select group_id from groups_students where student_id=?))',[$studentID]);


        return response()->json([
            'groups'=>$groups

        ]);

    }


        public function ajaxGetPayments(Request $request){
            $groupID = $request->izbor;
            $studentID = $request->student;

            $coursePrice = DB::select('select price from courses where id=(select course_id from groups where id=?)',[$groupID]);

            $payments = DB::select('select * from payments where student_id=? and course_id=(select course_id from groups where id=?)', [$studentID, $groupID]);




            return response()->json([
              'course_price'=>$coursePrice,
              'payments'=>$payments,

            ]);


        }


        public function report(Payment $payment){

      //  dd($payment->student_id);

        $payments = DB::select('select * from payments where student_id=? order by course_id',[$payment->student_id]);

        //dd($payments);

        $student = DB::select('select * from students where id=?',[$payment->student_id]);

        $courses = DB::select('select * from courses where id in (select course_id from payments where student_id=?)', [$payment->student_id]);

        $dug = 0;

        return view('admin.payments.report', [
            'payments'=>$payments,
            'student'=> $student[0],
            'courses'=> $courses,
            'dug'=> $dug
        ]);


        }




}
