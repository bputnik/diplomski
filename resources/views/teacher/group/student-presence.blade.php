<x-teacher.master>

    @section('content')

        <h1 class="mb-3">Pregled prisustva polaznika u grupi: <strong style="color:#4e73df">{{$group->name}}</strong></h1>


        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Polaznici</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">

                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                        <tr>
                            <th>Ime i prezime polaznika</th>
                            @foreach($dates as $date)
                                <th width="10%">{{\Carbon\Carbon::parse($date->lesson_date)->format('d.m.Y.')}}</th>
                            @endforeach
                            <th>Prisutan</th>
                            <th>Odsutan</th>
                        </tr>
                        </thead>

                        <tbody>
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
                                                          @elseif($attendance->attendance == 'O')
                                                            <td style="color: red">{{$attendance->attendance}}</td>
                                                          @endif
                                                @endif
                                            @endforeach
                                        @endforeach
                                    </tr>


                                @endif
                            @endfor
                        @endforeach



{{--                        --}}
{{--                            <tr>--}}
{{--                                <td>{{$attendance->student->name}} {{$attendance->student->surname}}</td>--}}
{{--                                <td>{{$attendance->lesson->lesson_number}}</td>--}}
{{--                                <td>{{$attendance->lesson->lesson_date}} </td>--}}
{{--                                <td style="color:#4e73df;">{{$attendance->lesson->lesson_content}}</td>--}}

{{--                            </tr>--}}
{{--                        @endforeach--}}
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
