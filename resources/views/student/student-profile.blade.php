<x-student.master>

    @section('content')

        @if(session()->has('student-profile-updated'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{session('student-profile-updated')}}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @elseif(session()->has('student-profile-not-updated'))
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                {{session('student-profile-not-updated')}}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif


        <h1>Moj profil</h1>

        <form action="{{route('student.student-profile-update', $student)}}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col">
                    <div class="form-group ">
                        <label for="name">Ime</label>
                        <input type="text"
                               name="name"
                               class="form-control col-lg-6 {{$errors->has('name') ? 'is-invalid' : ''}}"
                               id="name" required
                               value="{{$student->name}}" disabled>

                    </div>


                    <div class="form-group">
                        <label for="surname">Prezime</label>
                        <input type="text"
                               name="surname"
                               class="form-control col-lg-6 {{$errors->has('surname') ? 'is-invalid' : ''}}"
                               id="surname" required
                               value="{{$student->surname}}" disabled>
                    </div>


                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email"
                               name="email"
                               class="form-control col-lg-6 @error('email') is-invalid @enderror"
                               id="email" required
                               value="{{$student->email}}">
                        @error('email')
                        <div class="invalid-feedback">{{$message}}</div>
                        @enderror
                    </div>
                </div>

                <div class="col">
                    <div class="form-group">


                        <div class="card" style="width:18rem">
                            <img class="img-profile rounded-circle mt-3 ml-auto mr-auto" height="150px" width="150px" src="{{$student->avatar}}">


                            <div class="card-body">
                                <label for="avatar" class="h5 card-title">Izaberite sliku</label>
                                <input type="file"
                                       class="form-control-file @error('avatar') is-invalid @enderror"
                                       name="avatar"
                                       id="avatar">
                            </div>
                        </div>

                        @error('avatar')
                        <div class="invalid-feedback">{{$message}}</div>
                        @enderror
                    </div>

                </div>
            </div>

            <hr>

            <h3>Promena lozinke</h3>
            <div class="form-group">
                <label for="new-password">Nova lozinka</label>
                <input type="password"
                       name="password"
                       class="form-control col-lg-4 {{$errors->has('new-password') ? 'is-invalid' : ''}}"
                       id="password">
            </div>
            <div class="form-group">
                <label for="confirm-password">Potvrdi Lozinku</label>
                <input type="password"
                       name="confirm-password"
                       class="form-control col-lg-4 {{$errors->has('confirm-password') ? 'is-invalid' : ''}}"
                       id="confirm-password">

                @error('confirm-password')
                <div class="invalid-feedback">{{$message}}</div>
                @enderror
            </div>
            <hr>


            <div class="form-group">
                <button class="btn btn-primary">Sačuvaj izmene</button>
                <a href="{{route('student.index')}}" class="btn btn-danger">Odustani</a>
            </div>

        </form>



    @endsection


</x-student.master>
