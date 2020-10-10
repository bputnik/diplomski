<x-admin.master>

    @section('content')

        @if(session()->has('old-student-deleted'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{session('old-student-deleted')}}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

    <h1>Pregled podataka o starim polaznicima</h1>

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
                            <th>Student_id</th>
                            <th>Ime i prezime</th>
                            <th>Email</th>
                            <th>Adresa</th>
                            <th>Telefon</th>
                            <th>Datum rođenja</th>
                            <th>Kurs</th>
                            <th>Broj ugovora</th>
                            <th>Ime i prezime starateljsa</th>
                            <th>Email staratelja</th>
                            <th>Adresa staratelja</th>
                            <th>Telefon staratelja</th>
                            <th>Datum brisanja</th>
                            <th>Brisanje</th>
                        </tr>
                        </thead>
                        <tfoot>
                        <tr>
                            <th>Student_id</th>
                            <th>Ime i prezime</th>
                            <th>Email</th>
                            <th>Adresa</th>
                            <th>Telefon</th>
                            <th>Datum rođenja</th>
                            <th>Kurs</th>
                            <th>Broj ugovora</th>
                            <th>Ime i prezime starateljsa</th>
                            <th>Email staratelja</th>
                            <th>Adresa staratelja</th>
                            <th>Telefon staratelja</th>
                            <th>Datum brisanja</th>
                            <th>Brisanje</th>
                        </tr>
                        </tfoot>
                        <tbody>
                        @foreach($oldStudents as $oldStudent)
                            <tr>
                                <td>{{$oldStudent->student_id}}</td>
                                <td style="text-decoration-color: darkorange; font-weight: bold">{{$oldStudent->name}} {{$oldStudent->surname}}</td>
                                <td>{{$oldStudent->email}}</td>
                                <td>{{$oldStudent->address}}</td>
                                <td>{{$oldStudent->phone}}</td>
                                <td>{{$oldStudent->dob}}</td>
                                <td class="text-primary">{{$oldStudent->course}}</td>
                                <td>{{$oldStudent->contract_number}}</td>
                                <td>{{$oldStudent->trustee_name}} {{$oldStudent->trustee_surname}}</td>
                                <td>{{$oldStudent->trustee_email}}</td>
                                <td>{{$oldStudent->trustee_address}}</td>
                                <td>{{$oldStudent->trustee_phone}}</td>
                                <td>@if($oldStudent->created_at != null)
                                        {{$oldStudent->created_at->format('d.m.Y')}}
                                    @else
                                        {{'/'}}
                                    @endif
                                </td>
                                <td>
                                    <form method="post" action="{{route('admin.students.delete-old-student', $oldStudent->id)}}">
                                        @csrf
                                        @method('PUT')

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
