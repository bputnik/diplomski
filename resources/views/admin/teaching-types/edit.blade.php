<x-admin.master>

    @section('content')


        @if(session()->has('teaching-type-not-updated'))
            <div class="alert alert-warning">
                {{session('teaching-type-not-updated')}}
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
