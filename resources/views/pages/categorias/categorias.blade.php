@extends('pages.app',["current" => "categorias"])

@section('body')
<div class="card border">
    <div class="card-body">
        <h5 class="card-title">Cadastro de categorias</h5>

        @if (count($categorias) > 0)
                    
        <table class="table table-ordered table-hover">
            <thead>
                <tr>
                    <th>Código</th>
                    <th>Nome da Categoria</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($categorias as $cats)
                    <tr>
                        <td>{{$cats->id}}</td>
                        <td>{{$cats->nome}}</td>
                        <td>
                            <a 
                                 href="/categorias/editar/{{$cats->id}}"
                                 class="btn btn-sm btn-primary"
                            >
                                Editar
                            </a>
                            <a 
                                 href="/categorias/excluir/{{$cats->id}}"
                                 class="btn btn-sm btn-danger"
                            >
                                Excluir
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        
        @endif
    </div>
    <div class="card-footer">
        <a href="/categorias/novacategoria" class="btn btn-dark" role="button">Cadastrar Categoria</a>
    </div>
</div>
@endsection