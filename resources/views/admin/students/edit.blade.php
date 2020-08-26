<x-admin.master>

    @section('content')

        @if(session()->has('language-attached'))
            <div class="alert alert-success">
                {{session('language-attached')}}
            </div>
        @elseif(session()->has('language-detached'))
            <div class="alert alert-warning">
                {{session('language-detached')}}
            </div>
        @elseif(session()->has('teacher-not-updated'))
            <div class="alert alert-warning">
                {{session('teacher-not-updated')}}
            </div>
        @elseif(session()->has('teacher-updated'))
            <div class="alert alert-success">
                {{session('teacher-updated')}}
            </div>
        @endif

        <h1>Pregled i izmena podataka o polazniku</h1>
        <h3>Polaznik: <span style="color:#4e73df"> {{$student->name}} {{$student->surname}} </span></h3>

        <hr>
        <form action="{{route('admin.students.update', $student->id)}}" method="post">
            @csrf
            @method('PUT')

            <div class="form-group col-md-8">
                <div class="row">
                    <div class="form-group col">
                        <label for="name">Ime</label>
                        <input type="text" id="name" name="name" class="form-control" value="{{$student->name}}">
                    </div>
                    <div class="form group col">
                        <label for="surname">Prezime</label>
                        <input type="text" id="surname" name="surname" class="form-control" value="{{$student->surname}}">
                    </div>
                </div>

                <div class="row">
                <div class="form-group col-md-3">
                     <label for="dob">Datum rođenja</label>
                     <input type="text" id="dob" name="dob" class="form-control" readonly value="
                                @if($student->dob == null)
                                    {{'nema podatka'}}
                                @else
                                    {{$student->dob->format('d-m-Y')}}
                                @endif">
                </div>
                </div>

                <div class="row">
                    <div class="col">
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="text" id="email" name="email" class="form-control" value="{{$student->email}}">
                    </div>
                    </div>
                    <div class="col">
                    <div class="form-group">
                        <label for="phone">Telefon</label>
                        <input type="text" id="phone" name="phone" class="form-control" value="{{$student->phone}}">
                    </div>
                    </div>
                </div>


                <div class="row">
                    <div class="form-group col">
                        <label for="address">Adresa</label>
                        <input type="text" id="address" name="address" class="form-control" value="{{$student->address}}">
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-md-3">
                        <label for="start-work">Datum upisa</label>
                        <input type="text" id="start-work" name="start-work" class="form-control" readonly value="{{$student->created_at->format('d-m-Y')}}">
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

        <h3>Kursevi na koje je prijavljen polaznik</h3>





{{--        <!-- Tabela za dodavanje kurseva -->--}}
{{--        <div class="row">--}}
{{--            <div class="form-group col-md-8">--}}
{{--                <div class="row">--}}
{{--                    <div class="col-lg-12">--}}
{{--                        @if($courses->isNotEmpty())--}}
{{--                            <div class="card shadow mb-4">--}}
{{--                                <div class="card-header py-3">--}}
{{--                                    <h6 class="m-0 font-weight-bold text-primary">Dodajte ili uklonite kurs koji {{$student->name}} {{$student->surname}} predaje</h6>--}}
{{--                                </div>--}}

{{--                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">--}}
{{--                                    <thead>--}}
{{--                                    <tr>--}}
{{--                                        <th>Označeno</th>--}}
{{--                                        <th>Jezik</th>--}}
{{--                                        <th>Dodaj</th>--}}
{{--                                        <th>Ukloni</th>--}}
{{--                                    </tr>--}}
{{--                                    </thead>--}}
{{--                                    <tfoot>--}}
{{--                                    <tr>--}}
{{--                                        <th>Označeno</th>--}}
{{--                                        <th>Jezik</th>--}}
{{--                                        <th>Dodaj</th>--}}
{{--                                        <th>Ukloni</th>--}}
{{--                                    </tr>--}}
{{--                                    </tfoot>--}}
{{--                                    <tbody>--}}
{{--                                    @foreach($courses as $course)--}}
{{--                                        <tr>--}}
{{--                                            <td>--}}
{{--                                                <input type="checkbox"--}}
{{--                                                       @foreach($teacher->languages as $teacher_language)--}}
{{--                                                       @if($teacher_language->name == $language->name)--}}
{{--                                                       checked--}}
{{--                                                    @endif--}}
{{--                                                    @endforeach>--}}
{{--                                            </td>--}}
{{--                                            <td><strong>{{$language->name}}</strong></td>--}}
{{--                                            <td>--}}
{{--                                                <form method="post" action="{{route('admin.teachers.attach_language', $teacher)}}">--}}
{{--                                                    @csrf--}}
{{--                                                    @method('PUT')--}}

{{--                                                    <input type="hidden" name="language" value="{{$language->id}}">--}}

{{--                                                    <button class="btn btn-primary"--}}
{{--                                                            @if($teacher->languages->contains($language))--}}
{{--                                                            disabled--}}
{{--                                                        @endif--}}
{{--                                                    >Dodaj</button>--}}
{{--                                                </form>--}}
{{--                                            </td>--}}
{{--                                            <td>--}}
{{--                                                <form method="post" action="{{route('admin.teachers.detach_language', $teacher)}}">--}}
{{--                                                    @csrf--}}
{{--                                                    @method('PUT')--}}

{{--                                                    <input type="hidden" name="language" value="{{$language->id}}">--}}

{{--                                                    <button class="btn btn-danger"--}}
{{--                                                            @if(!$teacher->languages->contains($language))--}}
{{--                                                            disabled--}}
{{--                                                        @endif--}}
{{--                                                    >Ukloni</button>--}}
{{--                                                </form>--}}
{{--                                            </td>--}}
{{--                                        </tr>--}}
{{--                                    @endforeach--}}
{{--                                    </tbody>--}}

{{--                                </table>--}}
{{--                            </div>--}}
{{--                        @endif--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}

    @endsection

</x-admin.master>
