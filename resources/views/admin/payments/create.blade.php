<x-admin.master>

    @section('content')

        <script src="{{asset('vendor/jquery/jquery.js')}}"></script>
        <script src="{{asset('js/funkcije.js')}}"></script>


        <script>
            $(document).ready(function()
            {
                $("#courses_div").hide();
                $('#payments_table_div').hide();
            });
        </script>


        <h1>Nova uplata</h1>


{{--        <form action="{{route('admin.payments.choose-student')}}" method="post">--}}
{{--            @csrf--}}

            <div class="form-group">
                <label for="student_id">Izaberite polaznika</label>
                <select class="form-control col-lg-8" name="student_id" id="student_id" required>
                    <option value=""> -- izaberite polaznika -- </option>
                    @foreach($students as $student)
                        <option value="{{$student->id}}">
                            {{$student->name}} {{$student->surname}}
                        </option>
                        @endforeach
                        </option>
                </select>
            </div>

        <div class="form-group" id="courses_div">
            <label for="courses">Izaberite grupu za koju se vrši uplata</label>
            <select class="form-control col-lg-8" name="courses" id="courses" required>

{{--                <option value=""> -- izaberite kurs -- </option>--}}
{{--                @foreach($students as $student)--}}
{{--                    <option value="{{$student->id}}">--}}
{{--                        {{$student->name}} {{$student->surname}}--}}
{{--                    </option>--}}
{{--                    @endforeach--}}
{{--                    </option>--}}
            </select>
        </div>


        <div class="col-sm-9" id="payments_table_div">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Uplate</h6>
                </div>

                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th>Datum uplate</th>
                        <th>Iznos</th>
                        <th>Dugovanje</th>
                    </tr>
                    </thead>
                    <tfoot>
                    <tr>
                        <th>Datum uplate</th>
                        <th>Iznos</th>
                        <th>Dugovanje</th>
                    </tr>
                    </tfoot>
                    <tbody id="tabela">
{{--                    @foreach($groups as $group)--}}
{{--                        <tr>--}}
{{--                            <th>{{$group->course->language->name}}</th>--}}
{{--                            <th>{{$group->course->name}}</th>--}}
{{--                            <th>{{$group->teacher->name}} {{$group->teacher->surname}}</th>--}}
{{--                            <td>{{$group->classroom}}</td>--}}
{{--                            <th>{{'broj polaznika'}}</th>--}}
{{--                            <th>{{$group->starting_date->format('d-m-Y')}}</th>--}}
{{--                          --}}

{{--                        </tr>--}}
{{--                    @endforeach--}}
                    </tbody>

                </table>
            </div>
        </div>



{{--        </form>--}}





    @endsection()

</x-admin.master>
