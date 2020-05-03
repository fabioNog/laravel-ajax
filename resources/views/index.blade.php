
@extends('pages.app',["current" => "register/public/"])

@section('body')
    <div class="jumbotron bg-light border border-secondary">
        <div class="row">
            <div class="card-deck">
                <div class="card border border-dark">
                    <div class="card-body">
                        <h5 class="card-title">
                            Cadastro de Produtos
                        </h5>
                        <p class="cart-text">
                            Aqui você cadastra todos
                            os seus produtos
                        </p>
                        <a href="/produtos" class="btn btn-primary">Cadastrar</a>
                    </div>                                        
                </div>
                <div class="card border border-dark">
                    <div class="card-body">
                        <h5 class="card-title">
                            Cadastro de Categorias
                        </h5>
                        <p class="cart-text">
                            Aqui você cadastra todas
                            as suas Categorias</p>
                        <a href="/categorias" class="btn btn-primary">Cadastrar</a>
                    </div>                                        
                </div>
            </div>
        </div>
    </div>
@endsection