<x-teacher.master>

    @section('content')

        @if(session()->has('password-not-confirmed'))
            <div class="alert alert-danger">
                {{session('password-not-confirmed')}}
            </div>
        @elseif(session()->has('password-changed'))
            <div class="alert alert-success">
                {{session('password-changed')}}
            </div>
        @endif


        <h1>Moj profil</h1>

        <form action="{{route('teacher.teacher-profile-update', $teacher)}}" method="post" enctype="multipart/form-data">
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
                               value="{{$teacher->name}}">

                    </div>


                    <div class="form-group">
                        <label for="surname">Prezime</label>
                        <input type="text"
                               name="surname"
                               class="form-control col-lg-6 {{$errors->has('surname') ? 'is-invalid' : ''}}"
                               id="surname" required
                               value="{{$teacher->surname}}">
                    </div>


                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email"
                               name="email"
                               class="form-control col-lg-6 @error('email') is-invalid @enderror"
                               id="email" required
                               value="{{$teacher->email}}">
                        @error('email')
                        <div class="invalid-feedback">{{$message}}</div>
                        @enderror
                    </div>
                </div>

                <div class="col">
                    <div class="form-group">


                        <div class="card" style="width:18rem">
                            <img class="img-profile rounded-circle mt-3 ml-auto mr-auto" height="150px" width="150px" src="{{$teacher->avatar}}">
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

                    {{--            <div class="form-group">--}}
                    {{--                <img class="img-profile rounded-circle" height="150px" src="{{$admin->avatar}}">--}}
                    {{--            </div>--}}

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
            </div>

        </form>



    @endsection


</x-teacher.master>
