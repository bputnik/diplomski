<x-admin.master>
{{--@extends('components.admin.admin-master')--}}

@section('content')

    <h1 class="mb-3">Dobrodošli u administratorski panel</h1>

    <div class="row">

        <!-- Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-danger shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">Broj polaznika</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{$studentCount}}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-user-graduate fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <!-- Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Broj profesora</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{$teacherCount}}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-chalkboard-teacher fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Broj grupa</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{$groupCount}}</div>
                        </div>
                            <div class="col-auto">
                                <i class="fas fa-comments fa-2x text-gray-300"></i>
                            </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Broj kurseva</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{$courseCount}}</div>
                        </div>
                            <div class="col-auto">
                                <i class="fab fa-discourse fa-2x text-gray-300"></i>
                            </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <!-- . kraj prvog reda-->

    <div class="row">


        <!-- Donut Chart -->
        <div class="col-xl-4 col-lg-5">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Donut Chart</h6>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <div class="chart-pie pt-4">
                        <canvas id="myPieChart"></canvas>
                    </div>
                    <hr>
                    Styling for the donut chart can be found in the <code>/js/demo/chart-pie-demo.js</code> file.
                </div>
            </div>
        </div>

    </div>



@endsection

    @section('scripts')

        <script src="{{asset('/js/demo/chart-pie-demo.js')}}"></script>

    @endsection


</x-admin.master>
