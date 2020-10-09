<x-admin.master>



    @section('content')

        @if(session()->has('student-created'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{session('student-created')}}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @elseif(session()->has('student-deleted'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{session('student-deleted')}}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @elseif(session()->has('student-not-deleted'))
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                {{session('student-not-deleted')}}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif


        <h1>Pregled podataka o polaznicima</h1>


            <!-- DataTales Example -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Polaznici</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">

                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                            <tr>
{{--                                <th>Id</th>--}}
                                <th>Ime i prezime</th>
                                <th>Grupa</th>
                                <th>Datum upisa</th>
                                <th>Staralac</th>
                                <th>Brisanje</th>
                            </tr>
                            </thead>
                            <tfoot>
                            <tr>
{{--                                <th>Id</th>--}}
                                <th>Ime i prezime</th>

                                <th>Grupa</th>
                                <th>Datum upisa</th>
                                <th>Staralac</th>
                                <th>Brisanje</th>
                            </tr>
                            </tfoot>
                            <tbody>
                            @foreach($students as $student)
                                <tr>
{{--                                    <td>{{$student->id}}</td>--}}
                                    <td style="font-weight: bold;"><a href="{{route('admin.students.edit', $student->id)}}">{{$student->surname}} {{$student->name}}</a></td>
                                    <td>
                                        @foreach($student->groups as $group)
                                            {{$group->name}} <br>
                                        @endforeach
                                    </td>
                                    <td>{{$student->created_at->format('d-m-Y')}}</td>
                                    <td>
                                        @if($student->trustee_id == null)
                                            {{'/'}}
                                        @else
                                            <a href="{{route('admin.trustees.edit', $student->trustee->id)}}">
                                            {{$student->trustee->name}} {{$student->trustee->surname}}</td>
                                    @endif
                                    </a>
                                    <td>
                                        <form method="post" action="{{route('admin.students.destroy', $student->id)}}">
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
