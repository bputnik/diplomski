<x-admin.master>

    @section('content')

        @if(session()->has('group-detached'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{session('group-detached')}}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @elseif(session()->has('group-not-detached'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{session('group-not-detached')}}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
        @elseif(session()->has('group-attached'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{session('group-attached')}}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @elseif(session()->has('student-updated'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{session('student-updated')}}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @elseif(session()->has('student-not-updated'))
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                {{session('student-not-updated')}}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @elseif(session()->has('contract-number-exist'))
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                {{session('contract-number-exist')}}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

        @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
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
                                            <th>Naziv grupe</th>
                                            <th>Broj ugovora</th>
                                            <th>Ukloni iz grupe</th>
                                        </tr>
                                        </thead>

                                        <tbody>
                                        @foreach($groups as $group)
                                            @foreach($student->groups as $student_group)
                                                @if($group->id == $student_group->id)
                                                    <tr>
                                                        <td>{{$group->name}}</td>
{{--                                                        @foreach($group->students as $student)--}}
                                                        <td>{{$student_group->pivot->contract_number}}</td>
{{--                                                        @endforeach--}}
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

    {{--    Upis u jos jednu grupu    --}}


            <div class="form-group">
                <button class="btn btn-success mb-3" type="button" data-toggle="collapse" data-target="#collapseParent" aria-expanded="false" aria-controls="collapseParent">
                    <i class="fas fa-plus"></i> Upišite polaznika na novi kurs
                </button>

                <div class="collapse" id="collapseParent">
                    <div class="card card-body border-success">

                        <form action="{{route('admin.students.attach_group', $student->id)}}" method="post">
                            @csrf
                            @method('PUT')

                            <div class="row">
                                <div class="col">
                                    <div class="form-group ">
                                        <label for="group">Grupa u koju se upisuje</label>
                                        <select class="form-control" name="group" id="group"  >
                                            <option value=""> -- izaberite grupu -- </option>

{{--                                                @foreach($groups as $group)--}}
{{--                                                    @foreach($student->groups as $student_group)--}}
{{--                                                        @if($group->id != $student_group->id)--}}
                                                @for($i=0; $i<count($notInGroup); $i++)

                                                            <option value="{{$notInGroup[$i]->id}}">
                                                                {{$notInGroup[$i]->name}}
                                                            </option>
                                                @endfor


                                        </select>
                                    </div>
                                </div>

                                <div class="col">
                                    <div class="form-group  ">
                                        <label for="contract_number">Broj ugovora</label>
                                        <input type="text"
                                               name="contract_number"
                                               class="form-control col-lg-8"
                                               id="contract_number" required>
                                    </div>
                                </div>

                            </div>

                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="discount">Popust pri upisu %</label>
                                        <input type="number"
                                               name="discount"
                                               class="form-control col-lg-1"
                                               id="discount"
                                               value="0">
                                    </div>
                                </div>
                            </div>



                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <button class="btn btn-outline-success">Sačuvaj</button>
                                    </div>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>



{{--        kraj upisa u drugu grupu --}}



    @endsection

</x-admin.master>
