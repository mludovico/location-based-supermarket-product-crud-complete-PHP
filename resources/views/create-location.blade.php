@extends('templates.template')

@section('content')
  @php
    $edit = isset($location);
  @endphp
  <h1 class="text-center mt-3 mb-3">{{$edit ? 'Alterar Localização' : 'Cadastro de Locais'}}</h1>
  @if(isset($errors) && count($errors) > 0)
    <div class="text-center mt-4 mb-4 p-2 alert alert-danger">
      @foreach($errors->all() as $error)
        <p>{{$error}}</p>
      @endforeach
    </div>
  @endif
  <div class="col-8 m-auto">
  @php
    $url = $edit ? "locations/$location->id" : 'location';
  @endphp
    <form name="formCadastro" method="post" action="{{url($url)}}" id="formCadastro">
      @csrf
      <label for="aisle">Corredor</label>
      <input type="text" class="form-control" name="aisle" placeholder="Ex: A" value="{{$edit ? $location->aisle : ''}}" required>
      <label for="shelf">Prateleira</label>
      <input type="text" name="shelf" class="form-control" id="shelf" placeholder="Ex: 1" value="{{$edit ? $location->shelf : ''}}" required>
      <label for="side">Lado</label>
      <input type="text" name="side" class="form-control" id="side" placeholder="Ex: E" value="{{$edit ? $location->side : ''}}" required>
      <div class="col-8 m-auto text-center">
        <a href="/locations">
          <button type="button" class="btn btn-dark">VOLTAR</button>
        </a>
        <input type="submit" class="btn btn-success mt-5 mb-5" value="SALVAR">
      </div>
    </form>
  </div>
@endsection