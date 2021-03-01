@extends('layouts.app', ["current"=>"produtos"])
@section('body')
<div class="card border">
  <div class="card-body">
    <h5 class="card-title">Cadastro de produtos</h5>
    <table class="table table-ordered table-hover " id="tabelaProdutos">
      <thead>
        <tr>
          <th>Código</th>
          <th>Nome da categoria</th>
          <th>Nome do produto</th>
          <th>Quantidade</th>
          <th>Preço</th>
          <th>Ações</th>
        </tr>
      </thead>
      <tbody>

      </tbody>
    </table>
  </div>
  <div class="card-footer">
    <button class="btn btn-sm btn-primary" role="button" onClick="novoProduto()">Novo produto</button>
  </div>

  <div class="modal" tabindex="-1" role="dialog" id="dlgProdutos">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <form class="form-horizontal" id="formProduto">
          <div class="modal-header">
            <h5 class="modal-title">Novo produto</h5>
          </div>
          <div class="modal-body">
            <input type="hidden" id="id" class="form-control">

            <div class="form-group">
              <label for="nomeProduto">Nome do produto</label>
              <input type="text" class="form-control" name="nomeProduto"
                      id="nomeProduto" placeholder="Produto">

              <label for="estoque">Estoque do produto</label>
              <input type="number" class="form-control" name="estoqueProduto"
                      id="estoqueProduto" placeholder="Estoque">

              <label for="preco">Preco do produto</label>
              <input type="number" class="form-control" name="precoProduto"
                      id="precoProduto" placeholder="Preco">

               <label for="categoria">Categoria</label>
                  <select class="form-control" id="categoria" name="categoria">
                  </select>
            </div>

          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-primary btn-sm">Salvar</button>
            <button type="cancel" class="btn btn-danger btn-sm" data-dismiss="modal">Cancelar</button>
          </div>
        </form>
      </div>
    </div>
  </div>

</div>
@endsection

@section('javascript')
<script type="text/javascript">

  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': "{{csrf_token()}}"
    }
  })

  function novoProduto(){
    $('#id').val('');
    $('#nomeProduto').val('');
    $('#precoProduto').val('');
    $('#estoqueProduto').val('');
    $('#dlgProdutos').modal('show');
  }

  function carregarCategorias(){
    $.getJSON('/api/categorias', function(data){
      for(i=0; i<data.length;i++){
        opcao = '<option value="' + data[i].id + '">' +
          data[i].nome + '</option>';
          $('#categoria').append(opcao);
      }
    })
  }

function montarLinha(p){
  var linha = "<tr>" +
    "<td>" + p.id + "</td>" +
    "<td>" + p.categoria_id + "</td>" +
    "<td>" + p.nome + "</td>" +
    "<td>" + p.estoque + "</td>" +
    "<td>" + p.preco + "</td>" +
    "<td>" +
    '<button class="btn btn-primary btn-sm" onClick="editar(' + p.id +')"> Editar </button> ' +
    '<button class="btn btn-danger btn-sm" onClick="remover(' + p.id +')"> Apagar </button>' +
    "</td>" +
    "</tr>"
    return linha
}

  function carregarProdutos(){
    $.getJSON('/api/produtos', function(produtos){
      for(i=0; i<produtos.length; i++){
        linha = montarLinha(produtos[i])
        $('#tabelaProdutos>tbody').append(linha)
      }
    })
  }

  function remover(id){
    $.ajax({
      type: "DELETE",
      url: "/api/produtos/" + id,
      context: this,
      success: function(){
        console.log('removido')
        linhas = $('#tabelaProdutos>tbody>tr')
        e = linhas.filter(function(i, elemento){
          return elemento.cells[0].textContent == id
        })
        if(e){
          e.remove()
        }
      },
      error: function(){
        console.log(error)
      }
    })
  }

  function criarProdutos(){
    prod = {
       nome: $('#nomeProduto').val(),
       preco: $('#precoProduto').val(),
       estoque: $('#estoqueProduto').val(),
       categoria_id: $('#categoria').val()
       }
       $.post("/api/produtos", prod, function(data){
        produto = JSON.parse(data)
        linha = montarLinha(produto)
        $('#tabelaProdutos>tbody').append(linha)
       })
  }
  function editar(id){
    $.getJSON('/api/produtos/' + id, function(data){
      $('#id').val(data.id);
      $('#nomeProduto').val(data.nome);
      $('#precoProduto').val(data.preco);
      $('#estoqueProduto').val(data.estoque);
      $('#categoria').val(data.categoria_id);
      $('#dlgProdutos').modal('show');
    })

  }

  function salvarProdutos(){
    prod = {
       id: $('#id').val(),
       nome: $('#nomeProduto').val(),
       preco: $('#precoProduto').val(),
       estoque: $('#estoqueProduto').val(),
       categoria_id: $('#categoria').val()
       }
       console.log(prod);
      $.ajax({
      type: "PUT",
      url: "/api/produtos/" + prod.id,
      context: this,
      data: prod,
      success: function(data){
        linhas = $('#tabelaProdutos>tbody>tr')
        e = linhas.filter(function (i, e){
          return (e.cells[0].textContent == prod.id )
        })
        if (e){
          e[0].cells[0].textContent = prod.id
          e[0].cells[1].textContent = prod.categoria_id
          e[0].cells[2].textContent = prod.nome
          e[0].cells[3].textContent = prod.estoque
          e[0].cells[4].textContent = prod.preco
        }
        console.log('Atualizado')
      },
      error: function(error){
        console.log(error)
      }
    })
  }

  $('#formProduto').submit(function(event){
    event.preventDefault();
    if($('#id').val() != '')
      salvarProdutos();
    else
        criarProdutos();
    $('#dlgProdutos').modal('hide')
  })

  $(function(){
      carregarCategorias();
      carregarProdutos();
    })
</script>
@endsection
