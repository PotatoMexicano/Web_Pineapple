@extends('layouts.app')

@section('content')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script>
    $(document).ready(function(){
        $('[data-toggle="tooltip"]').tooltip(); 
    });
</script>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                        <a href="{{ route('vehicles.index') }}" class="btn btn-outline-dark" style="padding: 0;">Voltar</a>
                    <b style="margin-left: 1em;">{{ $vehicle->brand ." ". $vehicle->model}}</b>
                    <p class="right" data-toggle="tooltip" data-placement="top" title="{{$user->name}}">Placa: {{ $vehicle->license}}</p>
                </div>

                <div class="panel-body">
                    <div class="col-md-5">
                        <p><b>Placa: </b>{{ $vehicle->license}}</p>
                        <p><b>Marca: </b>{{ $vehicle->brand}}</p>
                        <p><b>Modelo: </b>{{ $vehicle->model}}</p>
                        <p><b>Ano: </b>{{ $vehicle->year}}</p>
                        <p><b>Cor: </b>{{ $vehicle->color}}</p>
                        <p><b>Tipo: </b>{{ $vehicle->type}}</p>
                        <p><b>Portas: </b>{{ $vehicle->doors}}</p>
                        <p><b>Detalhes: </b>{{ $vehicle->tags}}</p>
                    </div>                     
                    <div class="col-md-5">
                        @if ($vehicle->image !== null)
                            <img src="{{ url('storage/vehicles/'.$vehicle->image) }}" alt="exampleImage" style="background: transparent; border: none; width: 530px; height: 250px; border-radius: 3%;" class="img-thumbnail rounded float-right">
                        @endif
                    </div>  
                    <div class="col-md-2">
                        <a href="{{ route('vehicles.edit', $vehicle->id) }}" class="btn btn-warning right"><span>Editar</span></a>
                        <form action="{{ route('vehicles.destroy', $vehicle->id) }}" method="POST" class="form" name="dropVehicle">
                            {!! method_field('DELETE') !!}
                            {!! csrf_field() !!}
                            <button type="submit" class="btn btn-danger">Deletar</button>
                        </form>
                        
                    </div> 
                </div>
                
            </div>
            
        </div>
        
    </div>
</div>
@endsection
