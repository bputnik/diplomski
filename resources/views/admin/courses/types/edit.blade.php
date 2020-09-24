<x-admin.master>

    @section('content')

        @if(session()->has('courseType-not-updated'))
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    {{session('courseType-not-updated')}}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
        @endif

        <div class="row">
            <div class="col-sm-6">
                <h1>Izmena naziva vrste kursa: {{$courseType->name}}</h1>

                <form method="post" action="{{route('admin.courses.types.update', $courseType->id)}}" >
                    @csrf
                    @method('PUT')

                    <div class="form-group">
                        <label for="name">Naziv</label>
                        <input class="form-control" type="text" name="name" id="name" value="{{$courseType->name}}">
                    </div>
                    <button class="btn btn-primary">Izmeni</button>

                </form>
            </div>
        </div>


    @endsection


</x-admin.master>
