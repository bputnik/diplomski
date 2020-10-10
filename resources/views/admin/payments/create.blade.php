<x-admin.master>

    @section('content')

        <style>
            [required] {
                border: 1px solid red;
            }
        </style>

        <script src="{{asset('vendor/jquery/jquery.js')}}"></script>
        <script src="{{asset('js/funkcije.js')}}"></script>


        <script>
            $(document).ready(function()
            {
                $("#groups_div").hide();
                $('#payments_table_div').hide();
                $('#payment_div').hide();
                $('#save_button').hide();
            });
        </script>


        <h1>Nova uplata</h1>


        <form action="{{route('admin.payments.store')}}" method="post" >
            @csrf

            <div class="form-group">
                <label for="student_id">Izaberite polaznika</label>
                <select class="form-control col-lg-8" name="student_id" id="student_id" required>
                    <option value=""> -- izaberite polaznika -- </option>
                    @foreach($students as $student)
                        <option value="{{$student->id}}">
                            {{$student->surname}} {{$student->name}}
                        </option>
                        @endforeach
                        </option>
                </select>
            </div>

        <div class="form-group" id="groups_div">
            <label for="groups">Izaberite grupu za koju se vrši uplata</label>
            <select class="form-control col-lg-8" name="groups" id="groups" required>

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
                        <th>Način uplate</th>
                        <th>Iznos</th>
                        <th>Dugovanje</th>
                    </tr>
                    </thead>
                    <tfoot>
                    <tr>
                        <th>Datum uplate</th>
                        <th>Način uplate</th>
                        <th>Iznos</th>
                        <th>Dugovanje</th>
                    </tr>
                    </tfoot>
                    <tbody>

                    </tbody>

                </table>
            </div>
        </div>


        <div class="row" id="payment_div">

            <div class="col">
                <div class="form-group col-lg-6">
                    <label for="payment">Unesite sumu</label>
                    <input type="number"
                           name="payment"
                           class="form-control col-lg-8"
                           id="payment" required>
                </div>
            </div>

            <div class="col">
                <div class="form-group col-lg-6">
                    <label for="payment_method">Način uplate</label>
                    <select class="form-control" name="payment_method" id="payment_method" required >
                        <option value=""> -- izaberite način uplate -- </option>
                        <option value="0"> uplata na račun </option>
                        <option value="1"> gotovinska uplata </option>

                    </select>
                </div>
            </div>
        </div>


        <div class="form-group mt-3" id="save_button">
            <button class="btn btn-primary">Sačuvaj</button>
        </div>

        </form>


    @endsection()


</x-admin.master>
