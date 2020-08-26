<x-admin.master>

    @section('content')

        @if(session()->has('teaching-type-exist'))
            <div class="alert alert-danger">
                {{session('teaching-type-exist')}}
            </div>
        @elseif(session()->has('teaching-type-inserted'))
            <div class="alert alert-success">
                {{session('teaching-type-inserted')}}
            </div>
        @elseif(session()->has('teaching-type-deleted'))
            <div class="alert alert-success">
                {{session('teaching-type-deleted')}}
            </div>
        @elseif(session()->has('teaching-type-updated'))
            <div class="alert alert-success">
                {{session('teaching-type-updated')}}
            </div>
        @endif

        <h1 class="mb-3">Pregled tipova nastave</h1>

        <div class="row">

            <div class="col-sm-3">
                <form action="{{route('admin.teaching-types.store')}}" method="post">
                    @csrf

                    <div class="form-group">
                        <label for="name">Dodajte novi tip nastave:</label>
                        <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" placeholder="npr. individualni">
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
                        <h6 class="m-0 font-weight-bold text-primary">Tipovi nastave</h6>
                    </div>

                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                        <tr>
                            <th>Id</th>
                            <th>Tip nastave</th>
                            <th>Brisanje</th>
                        </tr>
                        </thead>
                        <tfoot>
                        <tr>
                            <th>Id</th>
                            <th>Tip nastave</th>
                            <th>Brisanje</th>
                        </tr>
                        </tfoot>
                        <tbody>
                        @foreach($teachingTypes as $teachingType)
                            <tr>
                                <td>{{$teachingType->id}}</td>
                                <td><a href="{{route('admin.teaching-types.edit', $teachingType->id)}}">{{$teachingType->name}}</a></td>
                                <td>
                                    <form action="{{route('admin.teaching-types.destroy', $teachingType->id)}}" method="post">
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
