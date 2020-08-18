

@extends('layouts.app')
@section('content')
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
                    Cadastrar novo veiculo
                </div>
                <div class="panel-body">
                    <div class="col-md-6">
                        <form action="{{ route('vehicles.store') }}" method="POST" name="addVehicle" enctype="multipart/form-data" >
                            <div class="form-group">
                                {!! csrf_field() !!}
                            </div>
                            <div class="form-group">
                                <label for="license">Placa</label>
                                <input class="form-control" type="text" name="license" id="license"  placeholder="Placa" required maxlength="8">
                            </div>
                            <div class="form-group">
                                <label for="brand">Marca</label>
                                <input class="form-control" type="text" name="brand" id="band" placeholder="Marca" required>
                            </div>
                            <div class="form-group">
                                <label for="model">Modelo</label>
                                <input class="form-control" type="text" name="model" id="model" placeholder="Modelo" required>
                            </div>
                            <div class="form-group">
                                <label for="type">Tipo</label> 
                                <select name="type" id="type" class="form-control">
                                    @php
                                        $types = $details[0];
                                    @endphp
                                    <option value="" selected>Selecione um tipo</option>
                                    @foreach ($types as $type)
                                        <option value="{{ $type }}">{{$type}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="tags">Detalhes</label>
                                <input class="form-control" type="text" name="tags" id="tags" placeholder="Detalhes" required>
                            </div>
                            <div class="form-group">
                                <label for="year">Ano</label>
                                <input class="form-control" type="number" name="year" id="year" placeholder="Ano" required min="1900"
                                value="@php
                                    echo date('Y');
                                @endphp">
                            </div>
                            <div class="form-group">
                                <label for="color">Cor</label> 
                                <select class="form-control" name="color" id="color">
                                    <option value="">Escolha uma cor</option>
                                    @php
                                        $colors = $details[1];
                                    @endphp
                                    @foreach ($colors as $color)
                                        <option value="{{ $color }}">{{ $color }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="doors">Portas</label> 
                                <select class="form-control" name="doors" id="doors">
                                    <option value="">Portas</option>
                                    @php
                                        $doors = $details[2];
                                    @endphp
                                    @foreach ($doors as $door)
                                        <option value="{{ $door }}">{{ $door }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <input type="file" accept="image/*" class="form-control-file" name="image" id="image" style="margin-bottom: 15px;">
                            <button type="submit" class="btn btn-success">Cadastrar</button>
                        </form>
                    </div>
                    <div class="col-md-6">
                        <img src="{{ asset('images/hatch.png') }}" alt="exampleImage" style="background: transparent; border: none" class="img-thumbnail rounded float-right">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

