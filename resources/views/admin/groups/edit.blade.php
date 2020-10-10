<x-admin.master>

    @section('content')

        <style>
            [required] {
                border: 1px solid red;
            }
        </style>

        <h1 class="mb-3">Izmena podataka o grupi</h1>

        @if($errors->has('name'))
            <div class="alert alert-danger">
                {{'Grupa sa tim imenom već postoji!'}}
            </div>

        @elseif ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif


        @if(session()->has('group-updated'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{session('group-updated')}}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @elseif(session()->has('group-not-updated'))
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    {{session('group-not-updated')}}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif


    <div class="d-flex">

        <div class="col-lg-6">

        <form action="{{route('admin.groups.update', $group->id)}}" method="post">
            @csrf
            @method('PUT')
                    <div class="form-group">
                        <label for="name">Naziv grupe</label>
                        <input type="text"
                               name="name"
                               class="form-control col-lg-10"
                               id="name"
                               value="{{$group->name}}"
                               required>
                    </div>

                    <div class="form-group">
                        <label for="classroom">Učionica</label>
                        <input type="text"
                               name="classroom"
                               class="form-control col-lg-8"
                               id="classroom"
                               value="{{$group->classroom}}"
                                >
                    </div>


            <div class="form-group">
                <label for="teaching_type">Tip nastave u grupi</label>
                <select class="form-control col-lg-6" name="teaching_type" id="teaching_type" required>
                    <option value="{{$group->teachingType->id}}"> {{$group->teachingType->name}} </option>
                    @foreach($teachingTypes as $teachingType)
                        <option value="{{$teachingType->id}}">
                            {{$teachingType->name}}
                        </option>
                        @endforeach
                        </option>
                </select>
            </div>

            <div class="form-group">
                <label for="language">Kurs</label>
                <select class="form-control col-lg-12" name="course" id="course" required>
                    <option value="{{$group->course->id}}">{{$group->course->name}} </option>
                    @foreach($courses as $course)
                        <option value="{{$course->id}}">
                            {{$course->name}}
                        </option>
                        @endforeach
                        </option>
                </select>
            </div>

            <div class="form-group">
                <label for="language">Profesor koji će voditi grupu</label>
                <select class="form-control col-lg-8" name="teacher" id="teacher" required>
                    <option value="{{$group->teacher->id}}"> {{$group->teacher->name}} {{$group->teacher->surname}} </option>
                    @foreach($teachers as $teacher)
                        <option value="{{$teacher->id}}">
                            {{$teacher->name}} {{$teacher->surname}}
                        </option>
                        @endforeach
                        </option>
                </select>
            </div>


            <div class="form-group">
                <label for="starting_date">Početak nastave</label>
                <input type="text"
                       name="starting_date"
                       class="form-control col-lg-4"
                       id="starting_date"
                        @if($group->starting_date == null)
                            value="{{'nije određen'}}"
                        @elseif($group->starting_date != null)
                            value="{{$group->starting_date->format('d-m-Y')}}"
                        @endif>
            </div>


            <div class="form-group">
                <label for="ending_date">Kraj nastave</label>
                <input type="text"
                       name="ending_date"
                       class="form-control col-lg-4"
                       id="ending_date"
                       @if($group->ending_date == null)
                            value="{{'nije određen'}}"
                        @elseif($group->ending_date != null)
                            value="{{$group->ending_date->format('d-m-Y')}}"
                    @endif>
            </div>


            <div class="form-group">
                <button type="submit" class="btn btn-primary">Sačuvaj izmene</button>
            </div>


        </form>
        </div>


        <div class="col-lg-6">
                    <div class="form-group">
                        <label for="">Upisani polaznici</label>
                    </div>

                    <!-- Tabela za pregled studenata -->
                    <div class="row">
                        <div class="form-group col-md-12">
                            <div class="row">
                                <div class="col-lg-12">
                                    @if($students->isNotEmpty())
                                        <div class="card shadow mb-4">
                                            <div class="card-header py-3">
                                                <h6 class="m-0 font-weight-bold text-primary">Polaznici upisani u ovu grupu </h6>
                                            </div>

                                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                                <thead>
                                                <tr>
                                                    <th>Ime i prezime</th>
                                                    <th>Broj ugovora</th>
{{--                                                    <th>Ukloni</th>--}}
                                                </tr>
                                                </thead>
{{--                                                <tfoot>--}}
{{--                                                <tr>--}}
{{--                                                    <th>Ime i prezime</th>--}}
{{--                                                    <th>Ukloni</th>--}}
{{--                                                </tr>--}}
{{--                                                </tfoot>--}}
                                                <tbody>
                                                @foreach($students as $student)
                                                    @foreach($group->students as $group_student)
                                                    @if($student->id == $group_student->id)
                                                    <tr>
                                                        <td><a style="text-decoration-color: darkorange;" href="{{route('admin.students.edit', $student->id)}}"><strong><span  style="color:darkorange;">{{$student->name}} {{$student->surname}}</span></strong></a></td>
                                                        <td>{{$group_student->pivot->contract_number}}</td>
{{--                                                        <td>--}}
{{--                                                            <form method="post" action="{{route('admin.groups.detach_student', $group)}}">--}}
{{--                                                                @csrf--}}
{{--                                                                @method('PUT')--}}

{{--                                                                <input type="hidden" name="student" value="{{$student->id}}">--}}

{{--                                                                <button class="btn btn-danger">Ukloni</button>--}}
{{--                                                            </form>--}}
{{--                                                        </td>--}}
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
        </div>
{{--   . kraj diva za tabelu     --}}


    </div>
{{-- . d flex--}}





    @endsection



</x-admin.master>
