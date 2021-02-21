@extends('master.app')
@section('title', '- Dashboard')
@section('sidebar')
    @parent
@endsection
@section('content')
        @yield('content')

        <!-- Heading -->
        <div class="card mb-4 wow fadeIn">

            <!--Card content-->
            <div class="card-body d-sm-flex justify-content-between">

                <h4 class="mb-2 mb-sm-0 pt-1">
                    <a href="{{ route('home') }}">Inicio</a>
                    <span>/</span>
                    <span>Dashboard</span>
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}ffff
                        </div>
                    @endif
                </h4>

            </div>

        </div>
        <!-- Heading -->

        <div class="row wow fadeIn">

            <div class="col-md-12 mb-4">

                <div class="card">

                    <div class="card-body">

                        <p class="lead">Ventas del mes</p>

                        <canvas id="myChart" width="400" height="150"></canvas>

                        {{-- Graficador de ventas semestrales --}}
                    </div>

                </div>

            </div>

        </div>

        <div class="row wow fadeIn">

            <!--Grid column-->
            <div class="col-md-6 mb-4">

                <!--Card-->
                <div class="card">

                <!--Card content-->
                <div class="card-body">

                    <!-- Table  -->
                    <table class="table table-hover">
                    <!-- Table head -->
                    <thead class="blue-grey lighten-4 text-center">
                        <tr>
                            <th>Nombre</th>
                            <th>E-mail</th>
                            <th>Rol</th>
                        </tr>
                    </thead>
                    <!-- Table head -->

                    <!-- Table body -->
                    <tbody>
                    @foreach ($lists as $user)
                        <tr class="text-center">
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->description }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                    <!-- Table body -->
                    </table>
                    <!-- Table  -->

                </div>

                </div>
                <!--/.Card-->

            </div>

            <div class="col-md-6 mb-4">

                <!--Card-->
                <div class="card">

                <!--Card content-->
                <div class="card-body">

                    <!-- Table  -->
                    <table class="table table-hover">
                    <!-- Table head -->
                    <thead class="blue lighten-4 text-center">
                        <tr>
                        <th>#</th>
                        <th>Nombre del producto</th>
                        <th>Precio</th>
                        <th>Stock</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($products as $product)
                            <tr class="text-center">
                                <td>{{ $product->id }}</td>
                                <td>{{ $product->nombre }}</td>
                                <td>{{ $product->precio_venta }}</td>
                                <td>{{ $product->stock }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>

                </div>

                </div>

            </div>

        </div>

        <script>

            fetch( "{{ route('ventas.getChart') }}" )
                .then( resp => resp.json() )
                .then( data => {

                    const chart  = data.resp;
                    /*const total = chart.data;
                    const monts = chart.labels;
                    console.log(total[0].total);*/
                    console.log(chart.data);

                    const datosVentas = {
                        label: "Ventas por mes",
                        data: chart.data,
                        backgroundColor: 'rgba(54, 162, 235, 0.2)',
                        borderColor: 'rgba(54, 162, 235, 1)',
                        borderWidth: 1,
                    };

                    var ctx = document.getElementById('myChart').getContext('2d');
                    var myChart = new Chart(ctx, {
                        type: 'bar',
                        data: {
                            labels: chart.labels,
                            datasets: [
                                datosVentas
                            ]
                        },
                        options: {
                            scales: {
                                yAxes: [{
                                    ticks: {
                                        beginAtZero: true
                                    }
                                }]
                            }
                        }
                    });

            }).catch( err => console.log(err) );


        </script>

@endsection



