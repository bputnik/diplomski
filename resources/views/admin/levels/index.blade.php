<x-admin.master>

    @section('content')

        @if(session()->has('level-deleted'))
            <div class="alert alert-success">
                {{session('level-deleted')}}
            </div>
        @endif


        <h1>Pregled jezičkih nivoa</h1>

        <div class="row">

{{--            <div class="col-sm-3">--}}
{{--                <form action="" method="post">--}}
{{--                    @csrf--}}

{{--                    <div class="form-group">--}}
{{--                        <label for="name">Dodajte jezički nivo u bazu:</label>--}}
{{--                        <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" placeholder="npr. italijanski">--}}
{{--                        <div>--}}
{{--                            @error('name')--}}
{{--                            <span><strong>{{$message}}</strong></span>--}}
{{--                            @enderror--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <button class="btn btn-primary btn-block" type="submit">Dodaj</button>--}}
{{--                </form>--}}
{{--            </div>--}}

            <div class="col-sm-9">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Jezički nivoi</h6>
                    </div>

                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                        <tr>
                            <th>Id</th>
                            <th>Oznaka po CEF-u</th>
                            <th>Naziv nivoa</th>
                            <th>Opis</th>
                            <th>Brisanje</th>
                        </tr>
                        </thead>
                        <tfoot>
                        <tr>
                            <th>Id</th>
                            <th>Oznaka po CEF-u</th>
                            <th>Naziv nivoa</th>
                            <th>Opis</th>
                            <th>Brisanje</th>
                        </tr>
                        </tfoot>
                        <tbody>
                        @foreach($levels as $level)
                            <tr>
                                <td>{{$level->id}}</td>
                                <td>{{$level->label}}</td>
                                <td><a href="{{route('admin.levels.edit', $level->id)}}">{{$level->name}}</a></td>
                                <td>{{$level->description}}</td>
                                <td>
                                    <form method="post" action="{{route('admin.levels.destroy', $level->id)}}">
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

</x-admin.master>
