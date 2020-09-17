<x-admin.master>

    @section('content')

        @if(session()->has('group-detached'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{session('group-detached')}}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
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

        <h3>Grupe u koje je upisan polaznik</h3>

            <!-- Tabela za pregled kurseva -->
            <div class="row">
                <div class="form-group col-md-10">
                    <div class="row">
                        <div class="col-lg-8">
                            @if($groups->isNotEmpty())
                                <div class="card shadow mb-4">
                                    <div class="card-header py-3">
                                        <h6 class="m-0 font-weight-bold text-primary">Grupe u koje je upisan polaznik </h6>
                                    </div>

                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                        <tr>
                                            <th>Naziv kursa</th>
                                            <th>Ukloni iz grupe</th>
                                        </tr>
                                        </thead>

                                        <tbody>
                                        @foreach($groups as $group)
                                            @foreach($student->groups as $student_group)
                                                @if($group->id == $student_group->id)
                                                    <tr>
                                                        <td>{{$group->name}}</td>
                                                        <td>
                                                            <form method="post" action="{{route('admin.students.detach_group', $student)}}">
                                                                @csrf
                                                                @method('PUT')

                                                                <input type="hidden" name="group" value="{{$group->id}}">

                                                                <button class="btn btn-danger">Ukloni</button>
                                                            </form>
                                                        </td>
                                                    </tr>
                                                @endif
                                            @endforeach
                                        @endforeach
                                        </tbody>

                                    </table>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            {{--   . kraj diva za tabelu     --}}



    @endsection

</x-admin.master>
