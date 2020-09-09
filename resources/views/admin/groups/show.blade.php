<x-admin.master>



    @section('content')

        @if(session()->has('group-created'))
            <div class="alert alert-success">
                {{session('group-created')}}
            </div>
        @elseif(session()->has('teacher-deleted'))
            <div class="alert alert-success">
                {{session('teacher-deleted')}}
            </div>
        @endif


        <h1 class="mb-3">Pregled podataka o grupama</h1>

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


                    <h1>Pregled podataka o grupama</h1>


                    <div class="col-sm-9">
                        <div class="card shadow mb-4">
                            <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-primary">Grupe</h6>
                            </div>

                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Naziv grupe</th>
                                    <th>Jezik</th>
                                    <th>Kurs</th>
                                    <th>Profesor</th>
                                    <th>Učionica</th>
                                    <th>Broj polaznika</th>
                                    <th>Datum početka nastave</th>
                                    <th>Brisanje</th>
                                </tr>
                                </thead>
                                <tfoot>
                                <tr>
                                    <th>Id</th>
                                    <th>Naziv grupe</th>
                                    <th>Jezik</th>
                                    <th>Kurs</th>
                                    <th>Profesor</th>
                                    <th>Učionica</th>
                                    <th>Broj polaznika</th>
                                    <th>Datum početka nastave</th>
                                    <th>Brisanje</th>
                                </tr>
                                </tfoot>
                                <tbody>
                                @foreach($groups as $group)
                                    <tr>
                                        <td>{{$group->id}}</td>
                                        <td><a href="{{route('admin.groups.edit', $group->id)}}">{{$group->name}}</a></td>
                                        <td>{{$group->course->language->name}}</td>
                                        <td>{{$group->course->name}}</td>
                                        <td>{{$group->teacher->name}} {{$group->teacher->surname}}</td>
                                        <td>{{$group->classroom}}</td>
                                        <td>{{'broj polaznika'}}</td>
                                        <td>{{$group->starting_date->format('d-m-Y')}}</td>
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

                @endsection
            </x-admin.master>





    @endsection
</x-admin.master>
