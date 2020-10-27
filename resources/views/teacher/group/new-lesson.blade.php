<x-teacher.master>

    @section('content')

        @if(session()->has('lesson-created'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{session('lesson-created')}}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @elseif(session()->has('lesson-not-created'))
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    {{session('lesson-not-created')}}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
        @endif


        <h1>Unos novog časa</h1>

{{--        <form action="{{route('teacher.group.new-lesson.store')}}" method="post" >--}}
        <form action="{{route('teacher.group.lesson-create', $group)}}" method="post" >
            @csrf

            <input hidden name="group_id" value="{{$group->id}}">

            <div class="row">
                <div class="col">
                    <div class="form-group ">
                        <label for="lesson_number_show">Redni broj časa</label>
                        <input type="number"
                               name="lesson_number_show"
                               class="form-control col-lg-2"
                               id="lesson_number_show"
                               value="{{$lesson_number}}" disabled>
                        <input hidden type="number" name="lesson_number" value="{{$lesson_number}}">
                    </div>
                </div>

                <div class="col">
                    <div class="form-group ">
                        <label for="lesson_date">Datum</label>
                        <input type="date"
                               name="lesson_date"
                               class="form-control col-lg-4"
                               id="lesson_date" required>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col">
                    <div class="form-group">
                        <label for="lesson_content">Nastavna jedinica</label>
                        <textarea
                            name="lesson_content"
                            class="form-control col-lg-8"
                            id="lesson_control"
                            cols="10"
                            rows="5" required></textarea>
                    </div>
                </div>

                <div class="col">
                    <div class="form-group">
                        <label for="lesson_note">Napomena</label>
                        <textarea
                            name="lesson_note"
                            class="form-control col-lg-8"
                            id="lesson_note"
                            cols="10"
                            rows="5"></textarea>
                    </div>
                </div>


            </div>


            <div class="form-group">
                <button class="btn btn-primary">Sačuvaj i pređi na unos prisustva polaznika</button>
            </div>

        </form>

    @endsection



</x-teacher.master>
