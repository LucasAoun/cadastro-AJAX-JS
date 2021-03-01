@extends('layouts.app', ["current"=>"categorias"])
@section('body')
    <div class="card border">
      <div class="card-body">
        <h5 class="card-title">Cadastro de categorias</h5>
        @if(count($cat)>0)
        <table class="table table-ordered table-hover">
          <thead>
            <tr>
              <th>Código</th>
              <th>Nome da categoria</th>
              <th>Ações</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($cat as $c)
              <tr>
                <td>{{$c->id}}</td>
                <td>{{$c->nome}}</td>
                <td>
                  <a href="/categorias/editar/{{$c->id}}" class="btn btn-sm btn-primary">Editar</a>
                  <a href="/categorias/apagar/{{$c->id}}" class="btn btn-sm btn-danger">Remover</a>
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
        @endif
      </div>
      <div class="card-footer">
        <a href="categorias/novo" class="btn btn-sm btn-primary" role="button">Nova categoria</a>
      </div>
    </div>
@endsection
