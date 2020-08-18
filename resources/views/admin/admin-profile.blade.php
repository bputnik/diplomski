<x-admin.master>

    @section('content')

    <h1>Moj profil</h1>

        <form action="{{route('admin.admin-profile-update', $admin )}}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')
<div class="row">
    <div class="col">
            <div class="form-group ">
                <label for="name">Ime</label>
                <input type="text"
                       name="name"
                       class="form-control col-lg-6"
                       id="name" required
                        value="{{$admin->name}}">
            </div>

            <div class="form-group">
                <label for="surname">Prezime</label>
                <input type="text"
                       name="surname"
                       class="form-control col-lg-6"
                       id="surname" required
                        value="{{$admin->surname}}">
            </div>


            <div class="form-group">
                <label for="email">Email</label>
                <input type="email"
                       name="email"
                       class="form-control col-lg-6"
                       id="email" required
                        value="{{$admin->email}}">
            </div>
    </div>

    <div class="col">
            <div class="form-group">
                <label for="avatar">Izaberite sliku</label>
                <input type="file" class="form-control-file" name="avatar" id="avatar">
            </div>

            <div class="form-group">
                <img class="img-profile rounded-circle" height="150px" src="https://source.unsplash.com/QAB-WJcbgJk/60x60">
            </div>

    </div>
</div>

            <hr>

            <h3>Promena lozinke</h3>
            <div class="form-group">
                <label for="new-password">Nova lozinka</label>
                <input type="text"
                       name="new-password"
                       class="form-control col-lg-4"
                       id="new-password">
            </div>
            <div class="form-group">
                <label for="confirm-password">Potvrdi Lozinku</label>
                <input type="password"
                       name="confirm-password"
                       class="form-control col-lg-4"
                       id="confirm-password">
            </div>
            <hr>


            <div class="form-group">
                <button class="btn btn-primary">Sačuvaj izmene</button>
            </div>

        </form>



    @endsection


</x-admin.master>
