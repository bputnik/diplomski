<x-student.master>


    @section('content')

        <h1 class="mb-3">Dobrodošli u kontrolni panel za učenike</h1>

        <h3 class="mb-3">Vaše grupe</h3>

        <div class="row mb-5">

            @foreach($student->groups as $group)

                <div class="card mr-5 shadow mr-3" style="min-width: 20rem">
                    <h5 class="card-header"><span style="color:#4e73df"><strong>{{$group->name}}</strong></span></h5>
                    <div class="card-body">
                        <h5 class="card-title">{{$group->course->name}}</h5>
                        <p class="card-text">Tip nastave: <strong>{{$group->teachingType->name}}</strong></p>
                        <p class="card-text">Fond časova: <strong>{{$group->course->number_of_lessons}}</strong></p>
                        <p class="card-text">Učionica: <strong>{{$group->classroom}}</strong></p>
                        <p class="card-text">Početak kursa:
                            @if($group->starting_date != null)
                                <strong>{{$group->starting_date->format('d.m.Y.')}}</strong>
                            @elseif($group->starting_date == null)
                                <strong>{{'datum nije određen'}}</strong>
                            @endif
                        </p>
                        <p class="card-text">Kraj kursa:
                            @if($group->ending_date != null)
                                <strong>{{$group->ending_date->format('d.m.Y.')}}</strong>
                            @elseif($group->ending_date == null)
                                <strong>{{'datum nije određen'}}</strong>
                            @endif
                        </p>

                        <a href="{{route('student.group.group-details', $group)}}" class="btn btn-primary">Pogledaj detalje</a>
                    </div>
                </div>

            @endforeach

        </div>

    @endsection


</x-student.master>
