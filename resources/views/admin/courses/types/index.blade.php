<x-admin.master>

    @section('content')

        @if(session()->has('courseType-exist'))
            <div class="alert alert-danger">
                {{session('courseType-exist')}}
            </div>
        @elseif(session()->has('courseType-inserted'))
            <div class="alert alert-success">
                {{session('courseType-inserted')}}
            </div>
        @elseif(session()->has('courseType-deleted'))
            <div class="alert alert-success">
                {{session('courseType-deleted')}}
            </div>
        @elseif(session()->has('courseType-updated'))
            <div class="alert alert-success">
                {{session('courseType-updated')}}
            </div>
        @endif

        <h1>Vrste kurseva</h1>

        <div class="row">

            <div class="col-sm-3">
                <form action="{{route('admin.courses.types.store')}}" method="post">
                    @csrf

                    <div class="form-group">
                        <label for="name">Dodajte novu vrstu kursa:</label>
                        <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" placeholder="npr. opšti">
                        <div>
                            @error('name')
                            <span><strong>{{$message}}</strong></span>
                            @enderror
                        </div>
                    </div>
                    <button class="btn btn-primary btn-block" type="submit">Dodaj</button>
                </form>
            </div>

            <div class="col-sm-9">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Vrste kurseva</h6>
                    </div>

                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                        <tr>
                            <th>Id</th>
                            <th>Vrsta kursa</th>
                            <th>Brisanje</th>
                        </tr>
                        </thead>
                        <tfoot>
                        <tr>
                            <th>Id</th>
                            <th>Vrsta kursa</th>
                            <th>Brisanje</th>
                        </tr>
                        </tfoot>
                        <tbody>
                        @foreach($courseTypes as $courseType)
                            <tr>
                                <td>{{$courseType->id}}</td>
                                <td><a href="{{route('admin.courses.types.edit', $courseType->id)}}">{{$courseType->name}}</a></td>
                                <td>
                                    <form method="post" action="{{route('admin.courses.types.destroy', $courseType->id)}}">
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
