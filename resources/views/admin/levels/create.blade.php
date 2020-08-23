<x-admin.master>

    @section('content')

    <h1>Kreiranje novog jezičkog nivoa</h1>

        <div class="mt-3 mb-3">

            <form action="{{route('admin.levels.store')}}" method="post">
                @csrf

                <div class="form-group">
                    <label for="label">Oznaka nivoa po CEF-u</label>
                    <input type="text" id="label" name="label" class="form-control col-lg-1" required>
                </div>

                <div class="row">
                    <div class="form-group col">
                        <label for="name">Naziv nivoa</label>
                        <input type="text" id="name" name="name" class="form-control col-lg-6" required>
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col">
                        <label for="description">Opis nivoa</label>
                        <textarea class="form-control" name="description" id="description" cols="30" rows="10"></textarea>
                    </div>
                </div>

                <div class="row">
                    <div class="col">
                        <button type="submit" class="btn btn-primary">Sačuvaj</button>
                    </div>
                </div>

            </form>

        </div>


    @endsection

</x-admin.master>
