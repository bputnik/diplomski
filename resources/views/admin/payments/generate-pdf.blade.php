<!DOCTYPE html>
<html lang="sh">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Veb sistem za poslovanje škole stranih jezika">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Izveštaj o dugovanjima</title>

    <!-- Custom fonts for this template-->
{{--    <script src="https://kit.fontawesome.com/8a74c7243d.js" crossorigin="anonymous"></script>--}}
{{--    <link href="{{asset('vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet" type="text/css">--}}
{{--    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">--}}

{{--    <link rel="stylesheet" href="{{asset('css/app.css')}}">--}}
<!-- Custom styles for this template-->
{{--    <link href="{{asset('css/sb-admin-2.min.css')}}" rel="stylesheet">--}}

    <!-- Custom styles for dataTables page -->
{{--    <link href="{{asset('vendor/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet">--}}



</head>

<style>
    body {
        font-family:"DeJaVu Sans Mono",monospace;
        font-size: 12px;
    }
</style>

<body>

        <h1>Izveštaj o dugovanjima polaznika</h1>
        <h3>Ime i prezime: <strong>{{$student->name}} {{$student->surname}} </strong></h3>


        @foreach($courses as $course)

            <div>
                <div>
                    <div>
                        <h3>Uplate za kurs <strong>{{$course->name}}</strong>
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
                        </h3>
                    </div>

                    <table  id="dataTable" width="95%">
                        <thead>
                        <tr style="border-bottom: 2px solid black;">
                            <th style="border-bottom: 2px solid black;">Datum uplate</th>
                            <th style="border-bottom: 2px solid black;">Na&#269;in uplate</th>
                            <th style="border-bottom: 2px solid black;">Iznos (RSD)</th>
                        </tr>
                        </thead>

                        <tbody>
                        @foreach($payments as $payment)

                            @if($course->id == $payment->course_id)
                                <tr>
                                    <td style="border-bottom: 1px solid black;">{{$payment->created_at->format('d-m-Y')}}</td>
                                    <td style="border-bottom: 1px solid black;">{{$payment->payment_method}}</td>
                                    <td style="border-bottom: 1px solid black;">{{$payment->amount}}</td>
                                    <td hidden style="color: white; border: 0px white;">{{$uplate += $payment->amount}}</td>
                                </tr>
{{--                                <tr hidden style="color:white;">--}}
{{--                                    --}}
{{--                                </tr>--}}
                            @endif
                        @endforeach
                        <tr >
                            <td  colspan="3">
                                Ukupno upla&#263;eno: <strong>{{$uplate}}</strong> RSD
                                <br>
                                Ukupno dugovanje: <strong>{{$cenaKursaSaPopustom - $uplate}}</strong> RSD
                            </td>
                        </tr>
                        <tr hidden style="color:white;">
                            <td hidden>
                                {{$uplate = 0}}
                                {{$cenaKursaSaPopustom=0}}
                            </td>
                        </tr>
                        </tbody>

                    </table>
                </div>
            </div>

        @endforeach



</body>
</html>




