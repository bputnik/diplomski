<x-admin.master>

    @section('content')

        @if(session()->has('course-not-updated'))
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                {{session('course-not-updated')}}
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


        <h1 class="mb-3">Izmena podataka o kursu</h1>


        <form action="{{route('admin.courses.update', $course->id)}}" method="post" enctype="multipart/form-data" >
            @csrf
            @method('PUT')

            <div class="form-group ">
                <label for="name">Naziv kursa</label>
                <input type="text"
                       name="name"
                       class="form-control col-lg-4"
                       id="name"
                       value="{{$course->name}}" required>
            </div>

            <div class="row">
                <div class="col">
                    <div class="form-group">
                        <label for="language_id">Jezik</label>
                        <select class="form-control col-lg-8" name="language_id" id="language_id" required>
                            <option value="{{$course->language->id}}">{{$course->language->name}}</option>
                            @foreach($languages as $language)
                                <option value="{{$language->id}}">
                                    {{$language->name}}
                                </option>
                                @endforeach
                                </option>
                        </select>
                    </div>
                </div>

                <div class="col">
                    <div class="form-group">
                        <label for="level_id">Nivo</label>
                        <select class="form-control col-lg-8" name="level_id" id="level_id" required>
                            <option value="{{$course->level->id}}"> {{$course->level->name}} </option>
                            @foreach($levels as $level)
                                <option value="{{$level->id}}">
                                    {{$level->label}} - {{$level->name}}
                                </option>
                                @endforeach
                                </option>
                        </select>
                    </div>
                </div>

                <div class="col">
                    <div class="form-group">
                        <label for="course-type_id">Tip kursa</label>
                        <select class="form-control col-lg-12" name="course_type_id" id="course_type_id" required>
                            <option value="{{$course->courseType->id}}"> {{$course->courseType->name}} </option>
                            @foreach($courseTypes as $courseType)
                                <option value="{{$courseType->id}}">
                                    {{$courseType->name}}
                                </option>
                                @endforeach
                                </option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label for="number_of_lessons">Fond časova</label>
                <input type="number"
                       name="number_of_lessons"
                       class="form-control col-lg-1"
                       id="number_of_lessons"
                       value="{{$course->number_of_lessons}}" required>
            </div>

            <div class="form-group">
                <Label>Završni ispit</Label>
                <div class="form-check">
                    <input type="radio" class="form-check-input" name="final_exam" value="1" required
                        @if($course->final_exam == 'Da')
                           checked
                        @endif
                    >
                    <label for="final_exam">Da</label>
                </div>

                <div class="form-check">
                    <input type="radio" class="form-check-input" name="final_exam" value="0"
                        @if($course->final_exam == 'Ne')
                           checked
                        @endif
                    >
                    <label for="final_exam">Ne</label>
                </div>
            </div>

            <div class="form-group">
                <label for="price">Cena kursa</label>
                <input type="number"
                       name="price"
                       class="form-control col-lg-1"
                       id="price"
                       value="{{$course->price}}"
                       required>
            </div>


            <div class="form-group">
                <button type="submit" class="btn btn-primary">Sačuvaj izmene</button>
            </div>

        </form>



    @endsection

</x-admin.master>
