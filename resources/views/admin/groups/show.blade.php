<x-admin.master>



    @section('content')

        @if(session()->has('group-created'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{session('group-created')}}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @elseif(session()->has('teacher-deleted'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{session('teacher-deleted')}}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif


        <h1 class="mb-3">Pregled podataka o grupama</h1>



                        <div class="card shadow mb-4">
                            <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-primary">Grupe</h6>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">

                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                <tr>
{{--                                    <th>Id</th>--}}
                                    <th>Naziv grupe</th>
                                    <th>Jezik</th>
                                    <th>Kurs</th>
                                    <th>Profesor</th>
                                    <th>Učionica</th>
                                    <th>Polaznici</th>
                                    <th>Datum početka nastave</th>
                                    <th>Datum završetka nastave</th>
                                    <th>Brisanje</th>
                                </tr>
                                </thead>
                                <tfoot>
                                <tr>
                                    <th>Naziv grupe</th>
                                    <th>Jezik</th>
                                    <th>Kurs</th>
                                    <th>Profesor</th>
                                    <th>Učionica</th>
                                    <th>Polaznici</th>
                                    <th>Datum početka nastave</th>
                                    <th>Datum završetka nastave</th>
                                    <th>Brisanje</th>
                                </tr>
                                </tfoot>
                                <tbody>
                                @foreach($groups as $group)
                                    <tr>
{{--                                        <td>{{$group->id}}</td>--}}
                                        <td style="font-weight: bold;"><a href="{{route('admin.groups.edit', $group->id)}}">{{$group->name}}</a></td>
                                        <td>{{$group->course->language->name}}</td>
                                        <td class="text-success">{{$group->course->name}}</td>
                                        <td>{{$group->teacher->name}} {{$group->teacher->surname}}</td>
                                        <td>{{$group->classroom}}</td>
                                        <td>
                                            @foreach($group->students as $student)
                                                <a href="{{route('admin.students.edit', $student->id)}}"> {{$student->name}} {{$student->surname}} </a>
                                                <br>
                                            @endforeach
                                        </td>
                                        <td>
                                            @if($group->starting_date != null)
                                            {{$group->starting_date->format('d-m-Y')}}
                                            @elseif($group->starting_date == null)
                                            {{'nije određen' }}
                                            @endif
                                        </td>
                                        <td>
                                            @if($group->ending_date != null)
                                                {{$group->ending_date->format('d-m-Y')}}
                                            @elseif($group->ending_date == null)
                                                {{'nije određen' }}
                                            @endif
                                        </td>
                                        <td>
                                            <form method="post" action="{{route('admin.groups.destroy', $group->id)}}">
                                                @csrf
                                                @method('DELETE')

                                                <button class="btn btn-danger">Obriši</button>
                                            </form>
                                        </td>

                                    </tr>
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



</x-admin.master>
