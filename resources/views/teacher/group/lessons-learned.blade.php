<x-teacher.master>

    @section('content')

        <h1 class="mb-3">Obrađene nastavne jedinice u grupi: <strong style="color:#4e73df">{{$group->name}}</strong></h1>

        <hr>
        <a href="{{route('teacher.group.group-details', $group)}}">
            <button class="btn btn-primary">Povratak na detalje o grupi</button>
        </a>
        <a href="{{route('teacher.group.student-presence', $group)}}">
            <button class="btn btn-outline-primary">Pregled prisustva polaznika</button>
        </a>
        <hr>


        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Polaznici</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">

                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                        <tr>
                            <th width="10%">Redni broj časa</th>
                            <th width="10%">Datum</th>
                            <th>Nastavna jedinica</th>
                            <th>Napomena</th>
                        </tr>
                        </thead>
                        <tfoot>
                        <tr>
                            <th>Redni broj časa</th>
                            <th>Datum</th>
                            <th>Nastavna jedinica</th>
                            <th>Napomena</th>
                        </tr>
                        </tfoot>
                        <tbody>
                        @for($i=0; $i<count($lessons);$i++)
                            <tr>
                                {{--                                            <td><a href="{{route('admin.students.edit', $student->id)}}">{{$student->name}} {{$student->surname}}</a></td>--}}
                                <td>{{$lessons[$i]->lesson_number}}</td>
                                <td>{{$lessons[$i]->lesson_date->format('d-m-Y')}} </td>
                                <td style="color:darkorange;">{{$lessons[$i]->lesson_content}}</td>
                                <td>{{$lessons[$i]->lesson_note}}</td>
                        @endfor
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
