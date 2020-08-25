<x-admin.master>

    @section('content')

        <h1 class="mb-3">Kreiranje novog profila polaznika</h1>

        @if($errors->has('email'))
            <div class="alert alert-danger">
                Email koji ste uneli već postoji u bazi! <br>
                Ako je roditelj već registrovan, izaberite ga iz padajuće liste.
            </div>
            @endif

        @if(session()->has('trustee-registered'))
            <div class="alert alert-success">
                {{session('trustee-registered')}}
            </div>
        @endif

{{--        @if ($errors->any())--}}
{{--            <div class="alert alert-danger">--}}
{{--                <ul>--}}
{{--                    @foreach ($errors->all() as $error)--}}
{{--                        <li>{{ $error }}</li>--}}
{{--                    @endforeach--}}
{{--                </ul>--}}
{{--            </div>--}}
{{--        @endif--}}

        <div class="form-group">
        <button class="btn btn-primary mb-3" type="button" data-toggle="collapse" data-target="#collapseParent" aria-expanded="false" aria-controls="collapseParent">
            Unesite podatke o roditelju / staraocu
        </button>

        <div class="collapse" id="collapseParent">
            <div class="card card-body border-primary">

                <form action="{{route('admin.trustees.store')}}" method="post">
                    @csrf

                    <div class="row">
                        <div class="col">
                            <div class="form-group ">
                                <label for="name">Ime staraoca</label>
                                <input type="text"
                                       name="name"
                                       class="form-control col-lg-8"
                                       id="name" required>
                            </div>
                        </div>

                        <div class="col">
                            <div class="form-group">
                                <label for="surname">Prezime staraoca</label>
                                <input type="text"
                                       name="surname"
                                       class="form-control col-lg-8"
                                       id=surname" required>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="email">Email staraoca</label>
                                <input type="email"
                                       name="email"
                                       class="form-control col-lg-8"
                                       id="email" required>
                            </div>
                        </div>
                        <div class="col">
                                <div class="form-group">
                                    <label for="phone">Telefon staraoca</label>
                                    <input type="text"
                                           name="phone"
                                           class="form-control col-lg-6"
                                           id="phone" required>
                                </div>
                        </div>

                    </div>

                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="address">Adresa staraoca</label>
                                <input type="text"
                                       name="address"
                                       class="form-control col-lg-10"
                                       id="address" required>
                            </div>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col">
                        <div class="form-group">
                            <button class="btn btn-primary">Sačuvaj</button>
                        </div>
                        </div>
                    </div>

                </form>
            </div>
        </div>
        </div>





        <form action="{{route('admin.students.store')}}" method="post" >
            @csrf


                <div class="form-group">
                    <label for="parent-select">Ako roditelj / staralac postoji u bazi, izaberite ga</label>
                    <select class="form-control col-lg-10" name="parent-select" id="parent-select"  >
                        <option value=""> -- roditelj / staralac -- </option>
                        @foreach($trustees as $trustee)
                            <option value="{{$trustee->id}}">
                                {{$trustee->name}} {{$trustee->surname}}, {{$trustee->address}}
                            </option>
                            @endforeach
                            </option>
                    </select>
                </div>



            <div class="row">
                <div class="col">
                    <div class="form-group ">
                        <label for="name">Ime</label>
                        <input type="text"
                                name="name"
                                class="form-control col-lg-8"
                                id="name" required>
                    </div>
                </div>

               <div class="col">
                   <div class="form-group">
                        <label for="surname">Prezime</label>
                        <input type="text"
                                name="surname"
                                class="form-control col-lg-8"
                                id="surname" required>
                   </div>
               </div>
            </div>

            <div class="row">
                <div class="col">
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email"
                               name="email"
                               class="form-control col-lg-8"
                               id="email" required>
                    </div>
                </div>

                <div class="col">
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password"
                               name="password"
                               class="form-control col-lg-8"
                               id="password"
                               value="{{\App\Http\Controllers\TeacherController::generatePassword()}}" required>
                    </div>
                </div>
            </div>

        <div class="row">
            <div class="col">
                <div class="form-group">
                    <label for="address">Adresa</label>
                    <input type="text"
                           name="address"
                           class="form-control col-lg-10"
                           id="address" required>
                </div>
            </div>

            <div class="col">
                <div class="form-group">
                    <label for="phone">Telefon</label>
                    <input type="text"
                           name="phone"
                           class="form-control col-lg-6"
                           id="phone" required>
                </div>
            </div>

        </div>

            <div class="row">
                <div class="col">
                    <div class="form-group">
                        <label for="dob">Datum rođenja</label>
                        <input type="date"
                               name="dob"
                               class="form-control col-lg-4"
                               id="dob">
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        <label for="registration_date">Datum upisa</label>
                        <input type="text"
                               name="registration_date"
                               class="form-control col-lg-4"
                               id="registration_date"
                               value="{{date('d-m-Y')}}" readonly>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col">
                    <div class="form-group">
                        <label for="course">Kurs na koji se upisuje</label>
                        <select class="form-control col-lg-8" name="language" id="language" required>
                            <option value=""> -- izaberite kurs -- </option>
                            @foreach($courses as $course)
                                <option value="{{$course->id}}">
                                    {{$course->name}}
                                </option>
                                @endforeach
                                </option>
                        </select>
                    </div>
                </div>


                <div class="col">
                    <div class="form-group">
                        <label for="course">Grupa u koju se upisuje</label>
                        <select class="form-control col-lg-8" name="language" id="language"  >
                            <option value=""> -- izaberite grupu -- </option>
                            @foreach($groups as $group)
                                <option value="{{$group->id}}">
                                    {{$group->name}}
                                </option>
                                @endforeach
                                </option>
                        </select>
                    </div>
                </div>
            </div>



            <div class="form-group">
                <button class="btn btn-primary">Sačuvaj</button>
            </div>

        </form>





    @endsection



</x-admin.master>
