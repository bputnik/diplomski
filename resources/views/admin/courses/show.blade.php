<x-admin.master>


    @section('content')

        <link href="{{asset('vendor/datatables/dataTables.bootstrap4.css')}}" rel="stylesheet">



        @if(session()->has('course-created'))
            <div class="alert alert-success">
                {{session('course-created')}}
            </div>
        @elseif(session()->has('course-deleted'))
            <div class="alert alert-success">
                {{session('course-deleted')}}
            </div>
        @elseif(session()->has('course-updated'))
            <div class="alert alert-success">
                {{session('course-updated')}}
            </div>
        @endif


        <h1>Pregled kurseva</h1>




        <div class="col-sm-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Kursevi</h6>
                </div>

                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th>Id</th>
                        <th>Naziv kursa</th>
                        <th>Jezik</th>
                        <th>Nivo</th>
                        <th>Tip kursa</th>
                        <th>Fond časova</th>
                        <th>Završni ispit</th>
                        <th>Cena</th>
                        <th>Brisanje</th>
                    </tr>
                    </thead>
                    <tfoot>
                    <tr>
                        <th>Id</th>
                        <th>Naziv kursa</th>
                        <th>Jezik</th>
                        <th>Nivo</th>
                        <th>Tip kursa</th>
                        <th>Fond časova</th>
                        <th>Završni ispit</th>
                        <th>Cena</th>
                        <th>Brisanje</th>
                    </tr>
                    </tfoot>
                    <tbody>
                    @foreach($courses as $course)
                        <tr>
                            <td>{{$course->id}}</td>
                            <td><a href="{{route('admin.courses.edit', $course->id)}}">{{$course->name}}</a></td>
                            <td>{{$course->language->name}}</td>
                            <td>{{$course->level->name}}</td>
                            <td>{{$course->courseType->name}}</td>
                            <td>{{$course->number_of_lessons}}</td>
                            <td>{{$course->final_exam}}</td>
                            <td>{{$course->price . ' RSD'}}</td>
                            <td>
                                <form method="post" action="{{route('admin.courses.destroy', $course->id)}}">
                                    @csrf
                                    @method('DELETE')

                                    <button class="btn btn-danger">Obriši</button>
                                </form>
                            </td>

                        </tr>
                    @endforeach
                    </tbody>

                </table>
            </div>
        </div>




    @endsection
</x-admin.master>
