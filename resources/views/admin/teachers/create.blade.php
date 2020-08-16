<x-admin.master>

    @section('content')

        <h1>Kreiranje novog nastavničkog profila</h1>

        <form action="{{route('admin.teachers.store')}}" method="post" >
            @csrf

            <div class="form-group ">
            <label for="name">Ime</label>
            <input type="text"
                    name="name"
                    class="form-control col-lg-4"
                    id="name" required>
            </div>

            <div class="form-group">
                <label for="surname">Prezime</label>
                <input type="text"
                       name="surname"
                       class="form-control col-lg-4"
                       id="surname" required>
            </div>

            <div class="form-group">
                <label for="jmbg">JMBG</label>
                <input type="text"
                       name="jmbg"
                       class="form-control col-lg-4"
                       id="jmbg" required>
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input type="email"
                       name="email"
                       class="form-control col-lg-4"
                       id="email" required>
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input type="password"
                       name="password"
                       class="form-control col-lg-4"
                       id="password"
                        value="{{\App\Http\Controllers\TeacherController::generatePassword()}}" required>

            </div>

            <div class="form-group">
                <label for="address">Adresa</label>
                <input type="text"
                       name="address"
                       class="form-control col-lg-8"
                       id="address" required>
            </div>


            <div class="form-group">
                <label for="phone">Telefon</label>
                <input type="text"
                       name="phone"
                       class="form-control col-lg-3"
                       id="phone" required>
            </div>

            <div class="form-group">
                <label for="dob">Datum rođenja</label>
                <input type="date"
                       name="dob"
                       class="form-control col-lg-4"
                       id="dob">
            </div>


            <div class="form-group">
                <label for="bank-account">Broj računa</label>
                <input type="text"
                       name="bank-account"
                       class="form-control col-lg-6"
                       id="bank-account">
            </div>

            <div class="form-group">
                <label for="start-work">Datum zaposlenja</label>
                <input type="date"
                       name="start-work"
                       class="form-control col-lg-4"
                       id="start-work"
                        value="{{date('d-m-Y')}}" required>
            </div>


            <div class="form-group">
                <label for="language">Jezik koji predaje</label>
            <select class="form-control col-lg-4" name="language" id="language" required>
                <option> -- izaberite jezik -- </option>
                    @foreach($languages as $language)
                        <option value="{{$language->id}}">
                            {{$language->name}}
                        </option>
                    @endforeach
                </option>
            </select>
            </div>

        <div class="form-group">
            <button class="btn btn-primary">Sačuvaj</button>
        </div>

        </form>





    @endsection



</x-admin.master>
