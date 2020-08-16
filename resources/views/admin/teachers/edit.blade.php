<x-admin.master>

    @section('content')

        <h1>Pregled i izmena podataka o profesoru</h1>
        <h3>Profesor: <span style="color:#4e73df"> {{$teacher->name}} {{$teacher->surname}} </span></h3>

        <hr>
        <form action="">
          <div class="form-group col-md-8">
            <div class="row">
                <div class="form-group col">
                    <label for="name">Ime</label>
                    <input type="text" id="name" name="name" class="form-control" value="{{$teacher->name}}">
                </div>
                <div class="form group col">
                    <label for="surname">Prezime</label>
                    <input type="text" id="surname" name="surname" class="form-control" value="{{$teacher->surname}}">
                </div>
            </div>

            <div class="row">
                  <div class="form-group col">
                      <label for="jmbg">JMBG</label>
                      <input type="text" id="jmbg" name="jmbg" class="form-control"  readonly value="{{$teacher->jmbg}}">
                  </div>
                  <div class="form group col">
                      <label for="dob">Datum rođenja</label>
                      <input type="text" id="dob" name="dob" class="form-control" readonly value="{{$teacher->dob->format('d-m-Y')}}">
                  </div>
            </div>

            <div class="row">
                <div class="form-group col">
                    <label for="email">email</label>
                    <input type="text" id="email" name="email" class="form-control" value="{{$teacher->email}}">
                </div>
                <div class="form-group col">
                    <label for="phone">Telefon</label>
                    <input type="text" id="phone" name="phone" class="form-control" value="{{$teacher->phone}}">
                </div>
            </div>
              <div class="row">
                  <div class="form-group col">
                      <label for="address">Adresa</label>
                      <input type="text" id="address" name="address" class="form-control" value="{{$teacher->address}}">
                  </div>
              </div>
              <div class="row">
                  <div class="form-group col">
                      <label for="bank-account">Broj bankovnog računa</label>
                      <input type="text" id="bank-account" name="bank-acount" class="form-control" value="{{$teacher->bank_account_number}}">
                  </div>
              </div>
              <div class="row">
                  <div class="form-group col-md-3">
                      <label for="start-work">Datum zaposlenja</label>
                      <input type="text" id="start-work" name="start-work" class="form-control" readonly value="{{$teacher->start_work->format('d-m-Y')}}">
                  </div>
              </div>
          </div>



        </form>


    @endsection

</x-admin.master>
