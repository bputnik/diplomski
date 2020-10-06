<x-student.master>

    @section('content')

        <h1 class="mb-3">Podaci o grupi: <strong style="color:#4e73df">{{$group->name}}</strong></h1>


{{--        <a href="{{route('student.group.lessons-learned', $group)}}">--}}
{{--            <button class="btn btn-outline-primary">Pregled obrađenih nastavnih jedinica</button>--}}
{{--        </a>--}}
{{--        <a href="{{route('student.group.student-presence', $group)}}">--}}
{{--            <button class="btn btn-outline-primary">Pregled prisustva</button>--}}
{{--        </a>--}}
{{--        <a href="{{route('student.group.student-payment', $group)}}">--}}
{{--            <button class="btn btn-outline-primary">Pregled prisustva</button>--}}
{{--        </a>--}}



        <div class="d-flex">

            <div class="card shadow mr-3 mb-5" style="width: 18rem;">
                <div class="card-header">
                    Osnovni podaci
                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">Kurs: <strong>{{$group->course->name}}</strong></li>
                    <li class="list-group-item">Tip nastave: <strong>{{$group->teachingType->name}}</strong></li>
                    <li class="list-group-item">Fond časova: <strong>{{$group->course->number_of_lessons}}</strong></li>
                    <li class="list-group-item">Broj održanih časova: <strong>{{$number_of_lessons}}</strong></li>
                    <li class="list-group-item">Učionica: <strong>{{$group->classroom}}</strong></li>
                    <li class="list-group-item">Početak kursa:
                        @if($group->starting_date != null)
                            <strong>{{$group->starting_date->format('d.m.Y.')}}</strong>
                        @elseif($group->starting_date == null)
                            <strong>{{'datum nije određen'}}</strong>
                        @endif
                    </li>
                    <li class="list-group-item">Kraj kursa:
                        @if($group->ending_date != null)
                            <strong>{{$group->ending_date->format('d.m.Y.')}}</strong>
                        @elseif($group->ending_date == null)
                            <strong>{{'datum nije određen'}}</strong>
                        @endif
                    </li>

                </ul>
            </div>


            <!-- DataTales Odrzani casovi i prisustvo -->
            <div class="card shadow mr-3 mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Održani časovi i prisustvo</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">

                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                            <tr>
                                <th>Redni broj časa</th>
                                <th>Datum</th>
                                <th>Nastavna jedinica</th>
                                <th>Prisustvo</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($attendances as $attendance)   {{-- ako je ucenik prebacen iz druge grupe, nece videti lekcije koje su odrzane dok on nije bio u grupi. Da bi se sve videle, treba ici preko lessons --}}
                                @if($attendance->student_id == $studentId)
                               <tr>
                                   <td>{{$attendance->lesson->lesson_number}}</td>
                                   <td>{{$attendance->lesson->lesson_date->format('d.m.Y')}}</td>
                                   <td style="color:darkorange">{{$attendance->lesson->lesson_content}}</td>
                                   <td>
                                       @if($attendance-> attendance == 'P')
                                           <span style="color:lawngreen">{{$attendance->attendance}}</span>
                                       @elseif($attendance-> attendance == 'O')
                                           <span style="color:red">{{$attendance->attendance}}</span>
                                       @endif
                                   </td>
                               </tr>
                               @endif
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>


            <!-- DataTales Uplate -->
            <div class="card shadow mr-3 mb-4 ">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Uplate za ovaj kurs</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">

                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                            <tr>
                                <th>Datum</th>
                                <th>Način uplate</th>
                                <th>Iznos</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr hidden>
                                <td hidden>{{$uplate = 0}}</td>
                                <td hidden>{{$discountPrice = 0}}</td>
                            </tr>
                            @foreach($payments as $payment)
                                    <tr>
                                        <td>{{$payment->created_at->format('d.m.Y')}}</td>
                                        <td>{{$payment->payment_method}}</td>
                                        <td>{{$payment->amount}}</td>
                                        <td hidden>{{$uplate += $payment->amount}}</td>
                                    </tr>
                            @endforeach
                            <tr>
                               <td colspan="3" class="font-weight-bold text-primary">
                                   Cena kursa: {{$coursePrice}} <br>
                                   Popust:
                                        @if($discount == null || $discount == 0)
                                            {{ 'bez popusta' }} <br>
                                        @else
                                            {{$discount}} % <br>
                                        @endif

                                   Ukupno za uplatu: {{$discountPrice = $coursePrice - ($coursePrice * $discount / 100)}} <br>

                                   Ukupno uplaćeno: <strong style="color: green;" >{{$uplate}}</strong> <br>
                                   Dug: <strong style="color: red;">{{$discountPrice - $uplate}}</strong> <br>
                               </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
        {{-- . kraj d-flex--}}

    @endsection

    @section('scripts')

        <!-- Page level plugins -->
            <script src="{{asset('vendor/datatables/jquery.dataTables.js')}}"></script>
            <script src="{{asset('vendor/datatables/dataTables.bootstrap4.min.js')}}"></script>

            <!-- Page level custom scripts -->
            <script src="{{asset('js/demo/datatables-demo.js')}}"></script>

    @endsection

</x-student.master>
