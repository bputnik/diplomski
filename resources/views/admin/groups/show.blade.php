<x-admin.master>



    @section('content')

        @if(session()->has('group-created'))
            <div class="alert alert-success">
                {{session('group-created')}}
            </div>
        @elseif(session()->has('teacher-deleted'))
            <div class="alert alert-success">
                {{session('teacher-deleted')}}
            </div>
        @endif


        <h1>Pregled podataka o grupama</h1>


    @endsection
</x-admin.master>
