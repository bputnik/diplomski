<x-admin.master>



    @section('content')

        @if(session()->has('teacher-created'))
            <div class="alert alert-success">
                {{session('teacher-created')}}
            </div>
        @elseif(session()->has('teacher-deleted'))
            <div class="alert alert-success">
                {{session('teacher-deleted')}}
            </div>
        @endif


        <h1>Pregled podataka o polaznicima</h1>


        <div class="col-sm-9">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Polaznici</h6>
                </div>

                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th>Id</th>
                        <th>Ime i prezime</th>
                        <th>Jezik</th>
                        <th>Kurs</th>
                        <th>Grupa</th>
                        <th>Datum upisa</th>
                        <th>Staralac</th>
                        <th>Brisanje</th>
                    </tr>
                    </thead>
                    <tfoot>
                    <tr>
                        <th>Id</th>
                        <th>Ime i prezime</th>
                        <th>Jezik</th>
                        <th>Kurs</th>
                        <th>Grupa</th>
                        <th>Datum upisa</th>
                        <th>Staralac</th>
                        <th>Brisanje</th>
                    </tr>
                    </tfoot>
                    <tbody>
                    @foreach($students as $student)
                        <tr>
                            <td>{{$student->id}}</td>
                            <td><a href="{{route('admin.students.edit', $student->id)}}">{{$student->name}} {{$student->surname}}</a></td>
                            <th>Jezik</th>
                            <th>Kurs</th>
                            <th>Grupa</th>
                            <td>{{$student->created_at->format('d-m-Y')}}</td>
                            <th>Staralac</th>
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

    @endsection
</x-admin.master>
