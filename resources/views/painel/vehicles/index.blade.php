@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Lista de veiculos
                    <a href="{{ route('vehicles.create') }}" role="button" class="btn btn-sucess right" style="padding: 0;">Adicionar</a>
                </div>

                <div class="panel-body table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Placa</th>
                                <th>Marca</th>
                                <th>Modelo</th>
                                <th>Ano</th>
                                <th>Cor</th>
                                <th>Ações</th>
                                @if ($level_user == 5)
                                    <th>API</th>
                                @endif

                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($vehicles as $vehicle)
                                <tr>
                                    <td>{{ $vehicle->license }}</td>
                                    <td>{{ $vehicle->brand }}</td>
                                    <td>{{ $vehicle->model }}</td>
                                    <td>{{ $vehicle->year }}</td>
                                    <td>{{ $vehicle->color }}</td>
                                    <td><a href="{{ route('vehicles.show', $vehicle->id) }}">Visualizar</a></td>
                                    @if ($level_user == 5)
                                        <td><a href="{{url('api',$vehicle->license)}}{{$pretty}}">Development</a></td>
                                    @endif
                                </tr>
                            @endforeach                           
                        </tbody>
                    </table>
                    {{$vehicles->links()}}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
