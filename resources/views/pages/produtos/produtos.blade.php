@extends('pages.app',["current" => "register/public/produtosajax"])

@section('body')

<div class="card border border-dark">
    <div class="card-body">
        <h5 class="card-title">Cadastro de Produtos Ajax</h5>
                    
        <table class="table table-ordered table-hover">
            <thead>
                <tr>
                    <th>Código</th>
                    <th>Estoque</th>
                    <th>Preço</th>
                    <th>Categoria</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>
    <div class="card-footer card-dark">
        <button class="btn btn-primary" role="button" onclick="novoProduto()">Cadastrar Ajax</button>
    </div>
</div>

<div class="modal" tabindex="-1" role="dialog" id="dlgProdutos">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form class="form-horizontal" id="formProduto">
                <div class="modal-header">
                    <h5 class="modal-title">Novo Produto</h5>
                </div>
                <div class="modal-body">

                    <input type="hidden" id="id" class="form-control">
                    {{-- Input do Estoque --}}
                    <div class="form-group">
                        <label for="estoqueProduto" class="control-label">Estoque</label>
                        <div class="input-group">
                            <input type="text" class="form-control" id="estoqueProduto" placeholder="Nome do Produto">
                        </div>
                    </div>
                    {{-- Input do Preço --}}
                    <div class="form-group">
                        <label for="precoProduto" class="control-label">Preço</label>
                        <div class="input-group">
                            <input type="number" class="form-control" id="precoProduto" placeholder="Preço do Produto">
                        </div>
                    </div>
                    {{-- Select da Categoria --}}
                    <div class="form-group">
                        <label for="categoriaProduto" class="control-label">Categoria</label>
                        <div class="input-group">
                            <select type="text" class="form-control" id="categoriaProduto" placeholder="Nome do Produto">
                            </select>                            
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Salvar</button>
                    <button type="cancel" class="btn btn-secondary" data-dissmiss="modal">Cancelar</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('javascript')
<script type="text/javascript">
    function novoProduto(){
        $('#id').val('');
        $('#estoqueProduto').val('');
        $('#precoProduto').val('');
        $('#categoriaProduto').val('');
        $('#dlgProdutos').modal('show')
    }

    function carregarCategorias(){
        $.getJSON('/api/categorias',function(data){        

            for(i=0;i<data.length;i++){
                opcao = '<option value = "' 
                    + data[i].id + '">' 
                    + data[i].nome 
                    + '</option>';
                $('#categoriaProduto').append(opcao);                    
            }
        });
    }

    $(function(){
        carregarCategorias();
    })
</script>
@endsection