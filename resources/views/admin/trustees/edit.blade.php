<x-admin.master>

    @section('content')

        <style>

            [required] {
                border: 1px solid red;
            }
        </style>

        @if(session()->has('trustee-updated'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{session('trustee-updated')}}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @elseif(session()->has('trustee-not-updated'))
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                {{session('trustee-not-updated')}}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif


        <h1>Izmena podataka o staraocu</h1>
        <p class="text-danger" style="line-height:0.5"><small>*sva polja uokvirena crvenom bojom moraju biti popunjena</small></p>

        <div class="row">
        <div class="col-lg-4">
            <ul class="list-group mt-3 mb-3">
                <li class="list-group-item list-group-item-secondary">Deca</li>
                @foreach($trustee->students as $student)
                    <li class="list-group-item text-warning font-weight-bold">{{$student->name}} {{$student->surname}}</li>
                @endforeach
            </ul>
        </div>
        </div>



        <form action="{{route('admin.trustees.update', $trustee->id)}}" method="post">
            @csrf
            @method('PUT')

            <div class="row">
                <div class="col">
                    <div class="form-group ">
                        <label for="name">Ime staraoca</label>
                        <input type="text"
                               name="name"
                               class="form-control col-lg-8"
                               id="name"
                               value="{{$trustee->name}}" required>
                    </div>
                </div>

                <div class="col">
                    <div class="form-group">
                        <label for="surname">Prezime staraoca</label>
                        <input type="text"
                               name="surname"
                               class="form-control col-lg-8"
                               id=surname"
                               value="{{$trustee->surname}}" required>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col">
                    <div class="form-group">
                        <label for="email">Email staraoca</label>
                        <input type="email"
                               name="email"
                               class="form-control col-lg-8"
                               id="email"
                               value="{{$trustee->email}}" required>
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        <label for="phone">Telefon staraoca</label>
                        <input type="text"
                               name="phone"
                               class="form-control col-lg-6"
                               id="phone"
                               value="{{$trustee->phone}}" required>
                    </div>
                </div>

            </div>

            <div class="row">
                <div class="col">
                    <div class="form-group">
                        <label for="address">Adresa staraoca</label>
                        <input type="text"
                               name="address"
                               class="form-control col-lg-10"
                               id="address"
                               value="{{$trustee->address}}" required>
                    </div>
                </div>

            </div>
            <div class="row">
                <div class="col">
                    <div class="form-group">
                        <button class="btn btn-primary">Sačuvaj</button>
                    </div>
                </div>
            </div>

        </form>





    @endsection


</x-admin.master>
