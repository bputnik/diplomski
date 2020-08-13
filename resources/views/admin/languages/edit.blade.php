<x-admin.master>

    @section('content')


        @if(session()->has('language-not-updated'))
            <div class="alert alert-warning">
                {{session('language-not-updated')}}
            </div>

        @endif



        <div class="row">
            <div class="col-sm-6">
                <h1>Izmena naziva jezika: {{$language->name}}</h1>

                <form method="post" action="{{route('admin.languages.update', $language->id)}}" >
                    @csrf
                    @method('PUT')

                    <div class="form-group">
                        <label for="name">Naziv</label>
                        <input class="form-control" type="text" name="name" id="name" value="{{$language->name}}">
                    </div>
                    <button class="btn btn-primary">Izmeni</button>

                </form>
            </div>
        </div>


    @endsection


</x-admin.master>
