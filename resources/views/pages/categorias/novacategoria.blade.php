@extends('pages.app', ["current" => "categorias"])

@section('body')
<div class="card boder">
    <div class="card-body">
        <form action="/categorias" method="POST">
            @csrf
            <div class="form-group">
                <label for="nomeCategoria">Nome da Categoria</label>
                <input 
                    type="text" 
                    name="nomeCategoria" 
                    id="nomeCategoria"
                    placeholder="Categoria"
                >                
            </div>
            <button type="submit" class="btn btn-dark btn-sm">Salvar</button>
            <button type="cancel" class="btn btn-danger btn-sm">Cancelar</button>
        </form>
    </div>
</div>    
@endsection