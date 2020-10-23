<x-admin.master>

    @section('content')

        <style>
            [required] {
                border: 1px solid red;
            }
        </style>


        @if(session()->has('language-attached'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{session('language-attached')}}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @elseif(session()->has('language-detached'))
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                {{session('language-detached')}}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @elseif(session()->has('teacher-not-updated'))
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                {{session('teacher-not-updated')}}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @elseif(session()->has('teacher-updated'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{session('teacher-updated')}}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

        <h1>Pregled i izmena podataka o profesoru</h1>
        <h3>Profesor: <span style="color:#4e73df"> {{$teacher->name}} {{$teacher->surname}} </span></h3>

        <hr>
        <form action="{{route('admin.teachers.update', $teacher->id)}}" method="post">
            @csrf
            @method('PUT')

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
                      <input type="text" id="dob" name="dob" class="form-control" readonly value="
                            @if($teacher->dob == null)
                                {{'nema podatka'}}
                            @else
                                {{$teacher->dob->format('d-m-Y')}}
                            @endif
                          ">
                  </div>
            </div>

            <div class="row">
                <div class="form-group col">
                    <label for="email">Email</label>
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

              <div class="row">
                  <div class="col">
                      <button type="submit" class="btn btn-primary">Sačuvaj izmene</button>
                  </div>
              </div>


          </div>
        </form>

        <hr>
        <!-- Tabela za dodavanje jezika -->
        <div class="row">
            <div class="form-group col-md-8">
                <div class="row">
                    <div class="col-lg-12">
                        @if($languages->isNotEmpty())
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Dodajte ili uklonite jezik koji {{$teacher->name}} {{$teacher->surname}} predaje</h6>
                                </div>

                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                    <tr>
                                        <th>Označeno</th>
                                        <th>Jezik</th>
                                        <th>Dodaj</th>
                                        <th>Ukloni</th>
                                    </tr>
                                    </thead>
                                    <tfoot>
                                    <tr>
                                        <th>Označeno</th>
                                        <th>Jezik</th>
                                        <th>Dodaj</th>
                                        <th>Ukloni</th>
                                    </tr>
                                    </tfoot>
                                    <tbody>
                                    @foreach($languages as $language)
                                        <tr>
                                            <td>
                                                <input type="checkbox"
                                                    @foreach($teacher->languages as $teacher_language)
                                                        @if($teacher_language->name == $language->name)
                                                            checked
                                                        @endif
                                                    @endforeach>
                                            </td>
                                            <td><strong>{{$language->name}}</strong></td>
                                            <td>
                                                <form method="post" action="{{route('admin.teachers.attach_language', $teacher)}}">
                                                    @csrf
                                                    @method('PUT')

                                                    <input type="hidden" name="language" value="{{$language->id}}">

                                                    <button class="btn btn-primary"
                                                            @if($teacher->languages->contains($language))
                                                            disabled
                                                        @endif
                                                    >Dodaj</button>
                                                </form>
                                            </td>
                                            <td>
                                                <form method="post" action="{{route('admin.teachers.detach_language', $teacher)}}">
                                                    @csrf
                                                    @method('PUT')

                                                    <input type="hidden" name="language" value="{{$language->id}}">

                                                    <button class="btn btn-danger"
                                                            @if(!$teacher->languages->contains($language))
                                                            disabled
                                                        @endif
                                                    >Ukloni</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>

                                </table>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

    @endsection

</x-admin.master>
