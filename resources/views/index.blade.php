@extends('layouts.app', ["current"=>"home"])
@section('body')
    <div class="jumbotron bg-light border-secondary">
        <div class="row">
            <div class="card-deck">
                <div class="card border-primary">
                    <div class="card-body">
                        <h5 class="card-title">Cadastro de produtos</h5>
                        <p class="card-text">
                            Aqui você cadastra todos os seus produtos
                            Só não esqueça as categorias
                        </p>
                        <a href="/produtos" class="btn btn-primary">Cadastre seus produtos</a>
                    </div>
                </div>
                <div class="card border-primary">
                    <div class="card-body">
                        <h5 class="card-title">Cadastro de categorias</h5>
                        <p class="card-text">
                            Aqui você cadastra todos as categorias
                        </p>
                        <a href="/categorias" class="btn btn-primary">Cadastre suas categoria</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
