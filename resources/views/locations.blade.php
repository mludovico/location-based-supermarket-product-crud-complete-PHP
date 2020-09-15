@extends('templates.template')

@section('content')
<h1 class="text-center mt-3 mb-3">Gerenciar Localizações</h1>
@if(isset($errors) && count($errors) > 0)
  <div class="text-center mt-4 mb-4 p-2 alert alert-danger">
    @foreach($errors->all() as $error)
      <p>{{$error}}</p>
    @endforeach
  </div>
@endif
<div class="col-8 m-auto">
  @csrf
    <table class="table table-hover table-sm">
      <thead>
        <tr>
          <th scope="col">Corredor</th>
          <th scope="col">Prateleira</th>
          <th scope="col">Lado</th>
          <th scope="col">Ações</th>
        </tr>
      </thead>
      <tbody>
        @foreach($locations as $location)
          <tr>
            <td scope="col">{{$location->aisle}}</td>
            <td scope="col">{{$location->shelf}}</td>
            <td scope="col">{{$location->side}}</td>
            <td scope="col">
              <a href="{{url("locations/$location->id/edit")}}">
                <button class="btn btn-sm btn-primary pl-3 pr-3">Editar</button>
              </a>
              <a href="{{url("locations/$location->id")}}" class="js-del">
                <button class="btn btn-sm btn-danger">Remover</button>
              </a>
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>
    <div class="col-8 m-auto text-center">
      <a href="{{url('products')}}">
        <button type="button" class="btn btn-dark mt-5 mb-5">VOLTAR</button>
      </a>
      <a href="{{url('locations/create')}}">
        <button type="button" class="btn btn-success mt-5 mb-5">ADICIONAR</button>
      </a>
    </div>
  </div>
@endsection