@extends('layouts.app', ["current"=>"produtos"]);
@section('body')
<div class="card border">
  <div class="card-body">
      <form action="/produtos" method="post">
        @csrf
          <div class="form-group">
              <label for="nomeProduto">Nome do produto</label>
              <input type="text" class="form-control" name="nomeProduto"
                      id="nomeProduto" placeholder="Produto">
              <label for="estoque">Estoque do produto</label>
              <input type="number" class="form-control" name="estoqueProduto"
                      id="estoqueProduto" placeholder="Estoque">
              <label for="estoque">Preco do produto</label>
              <input type="number" class="form-control" name="precoProduto"
                      id="precoProduto" placeholder="Preco">
              <label for="categoria">Categoria</label>
                  <select class="form-control" id="categoria" name="categoria">
                    @foreach ($categorias as $c)
                    <option value="{{$c->id}}">{{$c->nome}}</option>
                    @endforeach
                  </select>
          </div>
          <button type="submit" class="btn btn-success btn-sm">Salvar</button>
          <button type="submit" class="btn btn-danger btn-sm">Cancelar</button>
      </form>
  </div>
</div>
@endsection
