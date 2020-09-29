<x-admin.master>

    @section('content')

        <h1 class="mb-3">Kreiranje novog kursa</h1>


        <form action="{{route('admin.courses.store')}}" method="post" >
            @csrf

            <div class="form-group ">
                <label for="name">Naziv kursa</label>
                <input type="text"
                       name="name"
                       class="form-control col-lg-4"
                       id="name" required>
            </div>

            <div class="row">
                <div class="col">
            <div class="form-group">
                <label for="language">Jezik</label>
                <select class="form-control col-lg-8" name="language" id="language" required>
                    <option value=""> -- izaberite jezik -- </option>
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
                <label for="level">Nivo</label>
                <select class="form-control col-lg-8" name="level" id="level" required>
                    <option value=""> -- izaberite nivo -- </option>
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
                <label for="course-type">Tip kursa</label>
                <select class="form-control col-lg-12" name="course_type" id="course_type" required>
                    <option value=""> -- izaberite tip kursa -- </option>
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
                       id="number_of_lessons" min="1" required>
            </div>

            <div class="form-group">
                <Label>Završni ispit</Label>
                <div class="form-check">
                    <input type="radio" class="form-check-input" name="final_exam" value="1" required>
                    <label for="final-exam">Da</label>
                </div>
                <div class="form-check">
                    <input type="radio" class="form-check-input" name="final_exam" value="0">
                    <label for="final_exam">Ne</label>
                </div>
            </div>

            <div class="form-group">
                <label for="price">Cena kursa</label>
                <input type="number"
                       name="price"
                       class="form-control col-lg-1"
                       id="price" min="0" required>
            </div>


            <div class="form-group">
                <button class="btn btn-primary">Sačuvaj</button>
            </div>

        </form>



    @endsection

</x-admin.master>
