<x-teacher.master>

    @section('content')

        <h1>Unos novog časa i prisustva polaznika</h1>

{{--        <form action="{{route('teacher.group.new-lesson.store')}}" method="post" >--}}
        <form action="" method="post" >
            @csrf

            <div class="row">
                <div class="col">
                    <div class="form-group ">
                        <label for="lesson_number">Redni broj časa</label>
                        <input type="number"
                               name="lesson_number"
                               class="form-control col-lg-4"
                               id="lesson_number" required>
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
                            rows="5"></textarea>
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


            <hr>
            <!-- Tabela za prisustvo -->
            <div class="row">
                <div class="form-group col-md-8">
                    <div class="row">
                        <div class="col-lg-12">
                            @if($languages->isNotEmpty())
                                <div class="card shadow mb-4">
                                    <div class="card-header py-3">
                                        <h6 class="m-0 font-weight-bold text-primary">Obeležite prisutne / odsutne učenike</h6>
                                    </div>

                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                        <tr>
                                            <th>Označeno</th>
                                            <th>Jezik</th>
                                            <th>Dodaj</th>
                                            <th>Ukloni</th>
                                        </tr>
                                        </thead>
                                        <tfoot>
                                        <tr>
                                            <th>Označeno</th>
                                            <th>Jezik</th>
                                            <th>Dodaj</th>
                                            <th>Ukloni</th>
                                        </tr>
                                        </tfoot>
                                        <tbody>
                                        @foreach($languages as $language)
                                            <tr>
                                                <td>
                                                    <input type="checkbox"
                                                           @foreach($teacher->languages as $teacher_language)
                                                           @if($teacher_language->name == $language->name)
                                                           checked
                                                        @endif
                                                        @endforeach>
                                                </td>
                                                <td><strong>{{$language->name}}</strong></td>
                                                <td>
                                                    <form method="post" action="{{route('admin.teachers.attach_language', $teacher)}}">
                                                        @csrf
                                                        @method('PUT')

                                                        <input type="hidden" name="language" value="{{$language->id}}">

                                                        <button class="btn btn-primary"
                                                                @if($teacher->languages->contains($language))
                                                                disabled
                                                            @endif
                                                        >Dodaj</button>
                                                    </form>
                                                </td>
                                                <td>
                                                    <form method="post" action="{{route('admin.teachers.detach_language', $teacher)}}">
                                                        @csrf
                                                        @method('PUT')

                                                        <input type="hidden" name="language" value="{{$language->id}}">

                                                        <button class="btn btn-danger"
                                                                @if(!$teacher->languages->contains($language))
                                                                disabled
                                                            @endif
                                                        >Ukloni</button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>

                                    </table>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>






            <div class="form-group">
                <button class="btn btn-primary">Sačuvaj</button>
            </div>

        </form>

    @endsection



</x-teacher.master>
