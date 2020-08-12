<x-admin.master>

    @section('content')

        <h1>Dodavanje jezika</h1>

        <div class="col-sm-3 form-group">
        <form method="post" action="{{route('admin.languages.store')}}"  enctype="text/plain">
            @csrf

            <div class="form-group">
            <label for="name">Naziv jezika</label>
            <input type="text"
                   name="name"
                   id="name"
                    class="form-control"
                    placeholder="npr. francuski">
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-primary">Snimi</button>
            </div>

        </form>

        </div>




    @endsection


</x-admin.master>
