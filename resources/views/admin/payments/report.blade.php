<x-admin.master>

    @section('content')

        <h1>Izveštaj o dugovanjima polaznika</h1>
        <h3>Ime i prezime: <strong>{{$student->name}} {{$student->surname}} </strong></h3>


    <div class="form-group mt-3 mb-4">
        <button class="btn btn-primary"><i class="fas fa-print"></i>Štampanje izveštaja</button>
    </div>



    @foreach($courses as $course)

        <div class="col-sm-9">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Uplate za kurs <strong>{{$course->name}}</strong> <br> Cena kursa: <strong>{{$course->price}} </strong> RSD</h6>
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
                                <td hidden>{{$dug += $payment->amount}}</td>
                            </tr>
                        @endif
                    @endforeach
                    <tr >
                        <td class="font-weight-bold text-primary" colspan="3">
                            Ukupno dugovanje: <strong>{{$course->price - $dug}}</strong> RSD
                        </td>
                    </tr>
                    <tr hidden>
                        <td hidden>
                            {{$dug = 0}}
                        </td>
                    </tr>
                    </tbody>

                </table>
            </div>
        </div>

        @endforeach


    @endsection


</x-admin.master>
