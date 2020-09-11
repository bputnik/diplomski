<x-admin.master>

    @section('content')

        @if(session()->has('payment-added'))
            <div class="alert alert-success">
                {{session('payment-added')}}
            </div>
        @endif

        <h1>Pregled uplata</h1>


        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Pregled uplata</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                        <tr>
                            <th>Ime i prezime</th>
                            <th>Kurs</th>
                            <th>Datum uplate</th>
                            <th>Iznos</th>
                        </tr>
                        </thead>
                        <tfoot>
                        <tr>
                            <th>Ime i prezime</th>
                            <th>Kurs</th>
                            <th>Datum uplate</th>
                            <th>Iznos</th>
                        </tr>
                        </tfoot>
                        <tbody>
                        @foreach($payments as $payment)

                        <tr>
                            <td><a href="{{route('admin.payments.report', $payment->id)}}">{{$payment->student->name}} {{$payment->student->surname}}</a></td>
                            <td>{{$payment->course->name}}</td>
                            <td>{{$payment->created_at->format('d-m-Y')}}</td>
                            <td>{{$payment->amount}}</td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>


    @endsection

    @section('scripts')

        <!-- Page level plugins -->
            <script src="{{asset('vendor/datatables/jquery.dataTables.min.js')}}"></script>
            <script src="{{asset('vendor/datatables/dataTables.bootstrap4.min.js')}}"></script>

            <!-- Page level custom scripts -->
            <script src="{{asset('js/demo/datatables-demo.js')}}"></script>

        @endsection


</x-admin.master>
