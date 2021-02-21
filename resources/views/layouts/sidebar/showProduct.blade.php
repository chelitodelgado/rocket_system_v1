@extends('master.app')

@section('title', '- Detalles')

@section('sidebar')
    @parent

@endsection

@section('content')

@yield('content')

<div class="container-fluid mt-5">

    <div class="card mb-4 wow fadeIn animated" style="visibility: visible; animation-name: fadeIn;">
        <div class="card-body d-sm-flex justify-content-between">
            <h4 class="mb-2 mb-sm-0 pt-1">
                <a href="">Inicio</a>
                <span>/<a href="{{ '/producto' }}">Producto</a>/</span>
                <span>Detalles</span>
            </h4>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <div class="float-right"><a href="#" class="btn btn-success">Editar</a></div>
            <h2>Detalles del producto</h2>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-6">
                    <h5 class="card-title">{{ $data->nombre }}</h5>
                    <p class="card-text">
                        {{ $data->descripcion }}
                    </p>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">Codigo: {{ $data->codigo }} </li>
                        <li class="list-group-item">Stock disponible: {{ $data->stock }}</li>
                        <li class="list-group-item">Precio de compra: {{ $data->precio_unitario }}</li>
                        <li class="list-group-item">Precio de venta: {{ $data->precio_venta }}</li>
                        <li class="list-group-item">Categoria: {{ $data->categoria_id }}</li>
                        <li class="list-group-item">Proveedor: {{ $data->proveedor_id }}</li>
                    </ul>
                </div>
                <div class="col-6">

                    <img src="https://external-content.duckduckgo.com/iu/?u=https%3A%2F%2Fcdn.mwave.com.au%2Fimages%2F400%2FAC16453_1.jpg&f=1&nofb=1"
                        class="d-block w-100" alt="...">

                </div>
            </div>
        </div>
        <div class="card-footer text-muted">Ultima decha de actualización: {{ $data->updated_at }}</div>
    </div>

</div>

@endsection
