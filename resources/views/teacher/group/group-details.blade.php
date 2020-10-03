<x-teacher.master>

    @section('content')

        <h1 class="mb-3">Podaci o grupi: <strong style="color:#4e73df">{{$group->name}}</strong></h1>

        <hr>
        <a href="{{route('teacher.group.new-lesson', $group)}}">
            <button class="btn btn-success">Upišite novi čas i prisustvo polaznika</button>
        </a>
        <a href="{{route('teacher.group.lessons-learned', $group)}}">
            <button class="btn btn-outline-primary">Pregled obrađenih nastavnih jedinica</button>
        </a>
        <a href="{{route('teacher.group.student-presence', $group)}}">
            <button class="btn btn-outline-primary">Pregled prisustva polaznika</button>
        </a>
        <hr>


        <div class="d-flex">

            <div class="card shadow mr-5" style="width: 18rem;">
                <div class="card-header">
                    Osnovni podaci
                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">Kurs: <strong>{{$group->course->name}}</strong></li>
                    <li class="list-group-item">Tip nastave: <strong>{{$group->teachingType->name}}</strong></li>
                    <li class="list-group-item">Fond časova: <strong>{{$group->course->number_of_lessons}}</strong></li>
                    <li class="list-group-item">Broj održanih časova: <strong>{{$number_of_lessons}}</strong></li>
                    <li class="list-group-item">Učionica: <strong>{{$group->classroom}}</strong></li>
                    <li class="list-group-item">Početak kursa:
                        @if($group->starting_date != null)
                            <strong>{{$group->starting_date->format('d.m.Y.')}}</strong>
                        @elseif($group->starting_date == null)
                            <strong>{{'datum nije određen'}}</strong>
                        @endif
                    </li>
                    <li class="list-group-item">Kraj kursa:
                        @if($group->ending_date != null)
                            <strong>{{$group->ending_date->format('d.m.Y.')}}</strong>
                        @elseif($group->ending_date == null)
                            <strong>{{'datum nije određen'}}</strong>
                        @endif
                    </li>
                    <li class="list-group-item">Broj učenika u grupi: <strong>{{$number_of_students}}</strong></li>
                </ul>
            </div>


            <!-- DataTales Example -->
            <div class="card shadow mb-4 ">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Polaznici</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">

                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                            <tr>
                                <th>Ime i prezime</th>
                                <th>Telefon</th>
                                <th>Datum upisa</th>
                                <th>Staralac</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($students as $student)
                                @for($i=0; $i<count($studentsIds);$i++)
                                    @if($student->id == $studentsIds[$i]->student_id)
                                        <tr>
{{--                                            <td><a href="{{route('admin.students.edit', $student->id)}}">{{$student->name}} {{$student->surname}}</a></td>--}}
                                            <td><strong><span style="color:orange;">{{$student->name}} {{$student->surname}}</span></strong></td>

                                            <td>
                                                @if($student->phone != null)
                                                {{$student->phone}}
                                                @else
                                                    Staralac: <br>
                                                {{$student->trustee->phone}}
                                                @endif
                                                </td>
                                            <td>{{$student->created_at->format('d-m-Y')}}</td>
                                            <td>
                                                @if($student->trustee_id == null)
                                                    {{'/'}}
                                                @else
{{--                                                    <a href="{{route('admin.trustees.edit', $student->trustee->id)}}">--}}

                                                   <span style="color: darkgoldenrod">{{$student->trustee->name}} {{$student->trustee->surname}}</span></td>
                                            @endif
                                        </tr>
                                    @endif
                                @endfor
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
        {{-- . kraj d-flex--}}

    @endsection


</x-teacher.master>
