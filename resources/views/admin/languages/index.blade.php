<x-admin.master>

    @section('content')

        @if(session()->has('language-exist'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{session('language-exist')}}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @elseif(session()->has('language-inserted'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{session('language-inserted')}}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @elseif(session()->has('language-deleted'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{session('language-deleted')}}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @elseif(session()->has('language-not-deleted'))
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                {{session('language-not-deleted')}}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @elseif(session()->has('language-updated'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{session('language-updated')}}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

        <h1>Pregled svih podataka o jezicima</h1>

        <div class="row">

            <div class="col-sm-3">
                <form action="{{route('admin.languages.store')}}" method="post">
                    @csrf

                    <div class="form-group">
                        <label for="name">Dodajte jezik u bazu:</label>
                        <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" placeholder="npr. italijanski">
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
                        <h6 class="m-0 font-weight-bold text-primary">Jezici</h6>
                    </div>

                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                        <tr>
                            <th>Id</th>
                            <th>Jezik</th>
                            <th>Brisanje</th>
                        </tr>
                        </thead>
                        <tfoot>
                        <tr>
                            <th>Id</th>
                            <th>Jezik</th>
                            <th>Brisanje</th>
                        </tr>
                        </tfoot>
                        <tbody>
                        @foreach($languages as $language)
                            <tr>
                                <td>{{$language->id}}</td>
                                <td><a href="{{route('admin.languages.edit', $language->id)}}">{{$language->name}}</a></td>
                                <td>
                                    <form method="post" action="{{route('admin.languages.destroy', $language->id)}}">
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
