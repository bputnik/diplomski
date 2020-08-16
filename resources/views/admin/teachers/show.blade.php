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


    <h1>Pregled podataka o profesorima</h1>


    <div class="col-sm-9">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Profesori</h6>
            </div>

            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                <tr>
                    <th>Id</th>
                    <th>Ime i prezime</th>
                    <th>Datum zaposlenja</th>
                    <th>Obriši</th>
                </tr>
                </thead>
                <tfoot>
                <tr>
                    <th>Id</th>
                    <th>Ime i prezime</th>
                    <th>Datum zaposlenja</th>
                    <th>Obriši</th>
                </tr>
                </tfoot>
                <tbody>
                @foreach($teachers as $teacher)
                    <tr>
                        <td>{{$teacher->id}}</td>
                        <td><a href="{{route('admin.teachers.edit', $teacher->id)}}">{{$teacher->name}} {{$teacher->surname}}</a></td>
                        <td>{{$teacher->start_work->format('d-m-Y')}}</td>
                        <td>
                            <form method="post" action="{{route('admin.teachers.destroy', $teacher->id)}}">
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
