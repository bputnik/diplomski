<x-admin.master>

    @section('content')

        <h1>Dodavanje jezika</h1>

        <div class="col-sm-3 form-group">
        <form action="" method="post" enctype="text/plain">
            @csrf

            <label for="name">Naziv jezika</label>
            <input type="text"
                   name="name"
                   id="name"
                    class="form-control"
                    placeholder="npr. francuski">

        </form>

        </div>

        <div class="form-group">
            <button type="submit" class="btn btn-primary">Snimi</button>
        </div>


    @endsection


</x-admin.master>
