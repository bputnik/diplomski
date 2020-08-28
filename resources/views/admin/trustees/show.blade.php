<x-admin.master>



    @section('content')


        @if(session()->has('trustee-deleted'))
            <div class="alert alert-success">
                {{session('trustee-deleted')}}
            </div>
        @endif


        <h1>Pregled podataka o roditeljima / staraocima</h1>


        <div class="col-sm-9">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Roditelji / staraoci</h6>
                </div>

                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th>Id</th>
                        <th>Ime i prezime</th>
                        <th>Adresa</th>
                        <th>Email</th>
                        <th>Telefon</th>
                        <th>Deca</th>
                        <th>Brisanje</th>
                    </tr>
                    </thead>
                    <tfoot>
                    <tr>
                        <th>Id</th>
                        <th>Ime i prezime</th>
                        <th>Adresa</th>
                        <th>Email</th>
                        <th>Telefon</th>
                        <th>Deca</th>
                        <th>Brisanje</th>
                    </tr>
                    </tfoot>
                    <tbody>
                    @foreach($trustees as $trustee)
                        <tr>
                            <td>{{$trustee->id}}</td>
                            <td><a href="{{route('admin.trustees.edit', $trustee->id)}}">{{$trustee->name}} {{$trustee->surname}}</a></td>
                            <th>{{$trustee->address}}</th>
                            <th>{{$trustee->email}}</th>
                            <th>{{$trustee->phone}}</th>
                            <th>
                                @foreach($students as $student)
                                    @if($student->trustee_id == $trustee->id)
                                        <a href="{{route('admin.students.edit', $student->id)}}">
                                        {{$student->name}} {{$student->surname}}
                                    @endif
                                @endforeach
                                </a>
                            </th>
                            <td>
                                <form method="post" action="{{route('admin.trustees.destroy', $trustee->id)}}">
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
