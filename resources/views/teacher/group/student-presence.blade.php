<x-teacher.master>

    @section('content')

        <h1 class="mb-3">Pregled prisustva polaznika u grupi: <strong style="color:#4e73df">{{$group->name}}</strong></h1>


        <hr>
            <!-- Dugme za povratak na detalje o grupi -->
            <div class="mb-3">
                <a href="{{route('teacher.group.group-details', $group)}}" class="btn btn-primary">Povratak na detalje o grupi</a>
                <a href="{{route('teacher.group.lessons-learned', $group)}}" class="btn btn-outline-primary">Pregled obrađenih nastavnih jedinica</a>
            </div>

        <hr>

        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Pregled prisustva polaznika</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">

                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                        <tr>
                            <th>Ime i prezime polaznika</th>
                            @foreach($dates as $date)
                                <th>{{\Carbon\Carbon::parse($date->lesson_date)->format('d.m.Y.')}}</th>
                            @endforeach
                            <th  style="border-left: 2px solid grey">Prisutan</th>
                            <th >Odsutan</th>
                        </tr>
                        </thead>

                        <tbody>
                        <tr hidden>
                            <td hidden>
                                {{$sum_present = 0}} {{$sum_absent = 0}}
                            </td>
                        </tr>
                        @foreach($students as $student)
                            @for($i=0; $i<count($studentsIds);$i++)
                                @if($student->id == $studentsIds[$i]->student_id)
                                    <tr>
                                        <td><strong><span style="color:orange;">{{$student->name}} {{$student->surname}}</span></strong></td>

                                        @foreach($attendances as $attendance)
{{--                                            <td>{{$attendance->lesson->lesson_date}}</td>--}}
                                            @foreach($dates as $date)
{{--                                                <td>{{$date->lesson_date}}</td>--}}
                                                @if($attendance->lesson->lesson_date->format('Y-m-d') == $date->lesson_date && $attendance->student->id == $studentsIds[$i]->student_id)

                                                          @if($attendance->attendance == 'P')
                                                                <td style="color: green">{{$attendance->attendance}}</td>
                                                                <td hidden>{{$sum_present += 1}}</td>
                                                          @elseif($attendance->attendance == 'O')
                                                            <td style="color: red">{{$attendance->attendance}}</td>
                                                            <td hidden>{{$sum_absent += 1}}</td>
                                                          @endif
                                                @endif
                                            @endforeach
                                        @endforeach
                                        <td style="color:lawngreen; border-left: 2px solid grey;"><strong>{{$sum_present}}</strong></td>
                                        <td style="color:orangered"><strong>{{$sum_absent}}</strong></td>
                                        <td hidden>{{$sum_present = 0}} {{$sum_absent = 0}}</td>
                                    </tr>
                                @endif
                            @endfor
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>


    @endsection

    @section('scripts')

        <!-- Page level plugins -->
            <script src="{{asset('vendor/datatables/jquery.dataTables.js')}}"></script>
            <script src="{{asset('vendor/datatables/dataTables.bootstrap4.min.js')}}"></script>

            <!-- Page level custom scripts -->
            <script src="{{asset('js/demo/datatables-demo.js')}}"></script>

    @endsection

</x-teacher.master>
