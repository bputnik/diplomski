<x-admin.master>

    @section('content')

        @if(session()->has('level-not-updated'))
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                {{session('level-not-updated')}}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @elseif(session()->has('level-updated'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{session('level-updated')}}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif



    <h1>Izmena podataka za nivo <span style="color:#4e73df">{{$level->name}}</span></h1>


    <div class="mt-3 mb-3">

        <form action="{{route('admin.levels.update', $level->id)}}" method="post">
        @csrf
        @method('PUT')

            <div class="form-group">
                <label for="label">Oznaka nivoa po CEF-u</label>
                <input type="text" id="label" name="label" class="form-control col-lg-1" value="{{$level->label}}">
            </div>

            <div class="row">
                <div class="form-group col">
                    <label for="name">Naziv nivoa</label>
                    <input type="text" id="name" name="name" class="form-control col-lg-6" value="{{$level->name}}">
                </div>
            </div>

            <div class="row">
                <div class="form-group col">
                    <label for="description">Opis nivoa</label>
                    <textarea class="form-control" name="description" id="description" cols="30" rows="10">{{$level->description}}</textarea>
                </div>
            </div>


            <div class="row">
                <div class="col">
                    <button type="submit" class="btn btn-primary">Sačuvaj izmene</button>
                </div>
            </div>



        </form>

    </div>




    @endsection

</x-admin.master>
