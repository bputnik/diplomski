<x-admin.master>

    @section('content')

        <h1>Izveštaj o dugovanjima polaznika</h1>
        <h3>Ime i prezime: <strong>{{$student->name}} {{$student->surname}} </strong></h3>




    <div class="form-group mt-3 mb-4">
        <a href="{{route('admin.payments.generate-pdf', $student->id)}}"><button class="btn btn-primary"><i class="fas fa-print"></i> Napravi PDF</button></a>
    </div>



    @foreach($courses as $course)

        <div hidden>{{$cenaKursaSaPopustom = 0}}</div>

        <div class="col-sm-9">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Uplate za kurs <strong>{{$course->name}}</strong>
                        <br>
                        Cena kursa: <strong>{{$course->price}} </strong> RSD
                        <br>
                        Popust: <strong>
                                    @foreach($groups_students as $group_student)
                                        @foreach($groups as $group)
                                            @if($group->id == $group_student->group_id)
                                                @if($course->id == $group->course_id)
                                            {{$group_student->discount}} % = {{($course->price * $group_student->discount) / 100}} </strong> RSD
                                                 <br>
                                                   Cena kursa sa popustom: <strong>{{$cenaKursaSaPopustom = $course->price - ($course->price * $group_student->discount) / 100}}</strong> RSD
                                                @endif
                                            @endif
                                        @endforeach
                                    @endforeach
                    </h6>
                </div>

                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th>Datum uplate</th>
                        <th>Način uplate</th>
                        <th>Iznos (RSD)</th>
                    </tr>
                    </thead>
{{--                    <tfoot>--}}
{{--                    <tr>--}}

{{--                        <th>Datum uplate</th>--}}
{{--                        <th>Način uplate</th>--}}
{{--                        <th>Iznos</th>--}}
{{--                    </tr>--}}
{{--                    </tfoot>--}}
                    <tbody>
                    @foreach($payments as $payment)

                        @if($course->id == $payment->course_id)
                        <tr>
                            <td>{{$payment->created_at->format('d-m-Y')}}</td>
                            <td>{{$payment->payment_method}}</td>
                            <td>{{$payment->amount}}</td>
                        </tr>
                            <tr hidden>
                                <td hidden>{{$uplate += $payment->amount}}</td>
                            </tr>
                        @endif
                    @endforeach
                    <tr >
                        <td class="font-weight-bold text-primary" colspan="3">
                            Ukupno uplaćeno: <strong style="color: green;" >{{$uplate}}</strong> RSD
                            <br>
                            Ukupno dugovanje: <strong style="color: red;">{{$cenaKursaSaPopustom - $uplate}}</strong> RSD
                        </td>
                    </tr>
                    <tr hidden>
                        <td hidden>
                            {{$uplate = 0}}
                            {{$cenaKursaSaPopustom =0}}
                        </td>
                    </tr>
                    </tbody>

                </table>
            </div>
        </div>

        @endforeach




    @endsection


</x-admin.master>
