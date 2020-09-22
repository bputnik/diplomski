<x-teacher.master>


    @section('content')

        <h1 class="mb-3">Dobrodošli u kontrolni panel za nastavnike</h1>

        <h3>Vaše grupe</h3>

        <div class="row">

            @foreach($groups as $group)

            <div class="card mr-5" style="min-width: 20rem">
                <h5 class="card-header"><span style="color:#4e73df">{{$group->name}}</span></h5>
                <div class="card-body">
                    <h5 class="card-title">{{$group->course->name}}</h5>
                    <p class="card-text">Tip nastave: {{$group->teachingType->name}}</p>
                    <p class="card-text">Fond časova: {{$group->course->number_of_lessons}}</p>
                    <p class="card-text">Učionica: {{$group->classroom}}</p>
                    <p class="card-text">Početak kursa: {{$group->starting_day}}</p>
                    <p class="card-text">Kraj kursa: {{$group->ending_day}}</p>
                    <p hidden>{{$brojStudenata=0}}</p>
                    <p hidden>
                        @foreach($number_of_students as $nos)
                            @for($i=0; $i<count($nos);$i++)
                                @if($nos[$i]->group_id == $group->id)
                                    {{$brojStudenata = count($nos)}}
                                @endif
                            @endfor
                        @endforeach
                    </p>
                    <p class="card-text">Broj učenika u grupi: {{$brojStudenata}} </p>
                    <a href="{{route('teacher.group.group-details', $group)}}" class="btn btn-primary">Pogledaj detalje</a>
                </div>
            </div>

            @endforeach

        </div>

    @endsection


</x-teacher.master>
