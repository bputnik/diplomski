<x-teacher.master>


@section('content')

        <script src="{{asset('vendor/jquery/jquery.js')}}"></script>

        @if(session()->has('lesson-created'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{session('lesson-created')}}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif


        <h1>Unos novog časa i prisustva polaznika</h1>

        {{--        <form action="{{route('teacher.lesson-edit')}}" method="post" >--}}
        <form action="" method="post" >
            @csrf
            @method('PUT')

            <div class="row">
                <div class="col">
                    <div class="form-group ">
                        <label for="lesson_number">Redni broj časa</label>
                        <input type="number"
                               name="lesson_number"
                               class="form-control col-lg-4"
                               id="lesson_number"
                               value="{{$lesson->lesson_number}}" disabled>
                    </div>
                </div>

                <div class="col">
                    <div class="form-group ">
                        <label for="lesson_date">Datum</label>
                        <input type="text"
                               name="lesson_date"
                               class="form-control col-lg-4"
                               id="lesson_date"
                               value="{{$lesson->lesson_date->format('d.m.Y.')}}" disabled>
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
                            rows="5" disabled>{{$lesson->lesson_content}}</textarea>
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
                            rows="5" disabled>{{$lesson->lesson_note}}</textarea>
                    </div>
                </div>

            </div>

{{--            <div class="form-group">--}}
{{--                <button class="btn btn-primary">Izmeni</button>--}}
{{--            </div>--}}
        </form>

        <hr>

        <h3>Prisustvo polaznika</h3>
                        <!-- Tabela za prisustvo -->
                        <div class="row">
                            <div class="form-group col-md-8">
                                <div class="row">
                                    <div class="col-lg-12">
{{--                                        @if($students->isNotEmpty())--}}
                                            <div class="card shadow mb-4">
                                                <div class="card-header py-3">
                                                    <h6 class="m-0 font-weight-bold text-primary">Obeležite prisutne / odsutne učenike</h6>
                                                </div>

                                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                                    <thead>
                                                    <tr>

                                                        <th>Ime i prezime</th>
                                                        <th>Prisutan</th>
                                                        <th>Odstuan</th>
                                                    </tr>
                                                    </thead>
                                                    <tfoot>
                                                    <tr>

                                                        <th>Ime i prezime</th>
                                                        <th>Prisutan</th>
                                                        <th>Odsutan</th>
                                                    </tr>
                                                    </tfoot>
                                                    <tbody>
                                                    <tr><td hidden id="number_of_students">{{count($students)}}</td></tr>

                                                    @for($i=0; $i<count($students); $i++)
                                                        <tr id="row">
                                                            <td><strong><span style="color:darkorange">{{$students[$i]->name}} {{$students[$i]->surname}}</span></strong></td>
                                                            <td>

                                                                        <input type="hidden" name="lesson" id="lesson_{{$i}}" value="{{$lesson->id}}">
                                                                        <input type="hidden" name="student_id" id="student_id_{{$i}}" value="{{$students[$i]->id}}">
                                                                        <input type="hidden" name="group_id" id="group_id_{{$i}}" value="{{$group}}">

                                                                    <button class="btn btn-success" id="present_{{$i}}" onclick="saveAttendance({{$i}})">Prisutan</button>
                                                            </td>
                                                            <td>

                                                                    <button class="btn btn-danger" id="absent_{{$i}}" onclick="saveAbsence({{$i}})">Odsutan</button>

                                                            </td>
                                                        </tr>
                                                    @endfor
                                                    </tbody>

                                                </table>
                                            </div>
{{--                                        @endif--}}
                                    </div>
                                </div>
                            </div>
                        </div>


        <!-- Dugme za povratak na detalje o grupi -->
        <div class="mb-3">
            <a href="{{route('teacher.group.group-details', $group)}}">
                <button class="btn btn-primary">Povratak na detalje o grupi</button>
            </a>
        </div>


        <script>

            function saveAttendance(i) {

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
                    }
                });

                //$(this).attr('disabled', true);
                $("#present_" + i).attr('disabled', true);
                $("#absent_" + i).slideUp();

                let lesson = $("#lesson_" + i).val();
                console.log(lesson);
                let student_id = $("#student_id_" + i).val();
                console.log(student_id);
                let group_id = $("#group_id_" + i).val();
                console.log(group_id);


                $.ajax({
                    type: "POST",
                    url: "/teacher.attendance/save-attendance",
                    data:{lesson:lesson, student_id:student_id, group_id:group_id},
                    success:function(data){
                       // console.log(data);
                       // console.log(typeof data)
                    }
                });
            }

            function saveAbsence(i){

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
                    }
                });

                //$(this).attr('disabled', true);
                $("#present_" + i).slideUp();
                $("#absent_" + i).attr('disabled', true);

                let lesson = $("#lesson_" + i).val();
                console.log(lesson);
                let student_id = $("#student_id_" + i).val();
                console.log(student_id);
                let group_id = $("#group_id_" + i).val();
                console.log(group_id);


                $.ajax({
                    type: "POST",
                    url: "/teacher.attendance/save-absence",
                    data:{lesson:lesson, student_id:student_id, group_id:group_id},
                    success:function(data){
                        console.log(data);
                        console.log(typeof data)
                    }
                });


            }




        </script>



    @endsection




</x-teacher.master>
