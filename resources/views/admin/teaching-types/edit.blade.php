<x-admin.master>

    @section('content')


        @if(session()->has('teaching-type-not-updated'))
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                {{session('teaching-type-not-updated')}}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

            <h1 class="mb-3">Izmena naziva tipa nastave: {{$teachingType->name}}</h1>

        <div class="row">
            <div class="col-sm-6">


                <form method="post" action="{{route('admin.teaching-types.update', $teachingType->id)}}" >
                    @csrf
                    @method('PUT')

                    <div class="form-group">
                        <label for="name">Novi naziv</label>
                        <input class="form-control" type="text" name="name" id="name" value="{{$teachingType->name}}">
                    </div>
                    <button class="btn btn-primary">Izmeni</button>

                </form>
            </div>
        </div>


    @endsection


</x-admin.master>
