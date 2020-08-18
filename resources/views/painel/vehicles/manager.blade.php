@extends('layouts.app') @section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            @if (isset($errors) && count($errors) > 0)
            <div class="alert alert-danger">
                @foreach ($errors->all() as $error)
                <p>{{$error}}</p>
                @endforeach
            </div>
            @endif
            <div class="panel panel-default">
                <div class="panel-heading">
                    <a href="{{ route('vehicles.show', $vehicle->id) }}" class="btn btn-outline-dark" style="padding: 0;">Voltar</a>
                    <b style="margin-left: 1em;">{{ $vehicle->brand ." ". $vehicle->model}}</b>
                    <p class="right">Placa: {{ $vehicle->license}}</p>
                </div>
                <div class="panel-body">
                    <div class="col-md-6">
                        <form action="{{ route('vehicles.update', $vehicle->id) }}" method="POST" name="updateVehicle" class="form" enctype="multipart/form-data">
                            {!! method_field('PUT') !!}
                            <div class="form-group">
                                {!! csrf_field() !!}
                            </div>
                            <div class="form-group">
                                <label for="license">Placa</label>
                                <input type="text" name="license" id="license" class="form-control" placeholder="Placa" required value="{{ $vehicle->license }}">
                            </div>
                            <div class="form-group">
                                <label for="brand">Marca</label>
                                <input type="text" name="brand" id="band" class="form-control" placeholder="Marca" required value="{{ $vehicle->brand}}">
                            </div>
                            <div class="form-group">
                                <label for="model">Modelo</label>
                                <input type="text" name="model" id="model" class="form-control" placeholder="Modelo" required value="{{ $vehicle->model}}">
                            </div>
                            <div class="form-group">
                                <label for="type">Tipo</label>
                                <select name="type" id="type" class="form-control">
                        @foreach ($types as $type)
                        <option value="{{ $type }}" @if ($vehicle->type == $type)
                        selected
                        @endif>{{ $type }}</option>
                        @endforeach
                        </select>
                            </div>
                            <div class="form-group">
                                <label for="tags">Detalhes</label> <input type="text" name="tags" id="tags" class="form-control" placeholder="Detalhes" required value="{{ $vehicle->tags}}">
                            </div>
                            <div class="form-group">
                                <label for="year">Ano</label>
                                <input type="number" name="year" id="year" class="form-control" placeholder="Ano" required min="1900" value="{{ $vehicle->year }}">
                            </div>
                            <div class="form-group">
                                <label for="color">Cor</label>
                                <select name="color" id="color" class="form-control">
                           <option value="">Escolha uma cor</option>
                           @foreach ($colors as $color)
                           <option value="{{ $color }}" @if ($vehicle->color == $color)
                           selected
                           @endif>{{ $color }}</option>
                           @endforeach
                        </select>
                            </div>
                            <div class="form-group">
                                <label for="doors">Portas</label>
                                <select name="doors" id="doors" class="form-control">
                           <option value="">Portas</option>
                           @foreach ($doors as $door)
                           <option value="{{ $door }}" @if ($vehicle->doors == $door)
                           selected
                           @endif>{{ $door }}</option>
                           @endforeach     
                        </select>
                        </div>
                        <div class="custom-file" style="margin-bottom: 15px">
                            <input type="file" accept="image/*" class="custom-file" name="image" id="image" style="height: 34px !important">
                        </div>
                        <button type="submit" class="btn btn-success">Atualizar</button>
                        </form>
                    </div>
                    <div class="col-md-6">
                        @if ($vehicle->image)
                        <img src="{{ url('storage/vehicles/'.$vehicle->image) }}" alt="exampleImage" style="background: transparent; border: none; width: 700px; height: 300px; border-radius: 3%;" class="img-thumbnail rounded float-right"> @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection