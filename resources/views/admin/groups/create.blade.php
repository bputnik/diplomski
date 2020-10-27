<x-admin.master>

    @section('content')

        <style>
            [required] {
                border: 1px solid red;
            }
        </style>

        <h1 class="mb-3">Kreiranje nove grupe</h1>
        <p class="text-danger" style="line-height:0.5"><small>*sva polja uokvirena crvenom bojom moraju biti popunjena</small></p>

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


        <form action="{{route('admin.groups.store')}}" method="post" >
            @csrf

            <div class="row">
                <div class="col">
            <div class="form-group">
                <label for="name">Naziv grupe</label>
                <input type="text"
                       name="name"
                       class="form-control col-lg-8"
                       id="name" required>
            </div>
                </div>

                <div class="col">
            <div class="form-group">
                <label for="classroom">Učionica</label>
                <input type="text"
                           name="classroom"
                           class="form-control col-lg-8"
                           id="classroom">
            </div>
                </div>

            </div>

            <div class="form-group">
                <label for="teaching_type">Tip nastave u grupi</label>
                <select class="form-control col-lg-4" name="teaching_type" id="teaching_type" required>
                    <option value=""> -- izaberite tip nastave -- </option>
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
                <select class="form-control col-lg-4" name="course" id="course" required>
                    <option value=""> -- izaberite kurs -- </option>
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
                <select class="form-control col-lg-4" name="teacher" id="teacher" required>
                    <option value=""> -- izaberite profesora -- </option>
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
                <input type="date"
                       name="starting_date"
                       class="form-control col-lg-4"
                       id="starting_date">
            </div>


            <div class="form-group">
                <label for="ending_date">Kraj nastave</label>
                <input type="date"
                       name="ending_date"
                       class="form-control col-lg-4"
                       id="ending_date">
            </div>


            <div class="form-group">
                <button class="btn btn-primary">Sačuvaj</button>
            </div>

        </form>





    @endsection



</x-admin.master>
