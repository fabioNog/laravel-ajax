@extends('pages.app',["current" => "register/public/produtosajax"])

@section('body')

<div class="card border border-dark">
    <div class="card-body">
        <h5 class="card-title">Cadastro de Produtos Ajax</h5>
                    
        <table class="table table-ordered table-hover" id="tabelaProduto">
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
                {{ csrf_field() }}
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
                    <button type="cancel" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('javascript')  
<script type="text/javascript">
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN' : "csrf_field()"
        }
    })

    function novoProduto(){
        $('#id').val('');
        $('#estoqueProduto').val('');
        $('#precoProduto').val('');
        $('#categoriaProduto').val('');
        $('#dlgProdutos').modal('show')
    }

    // Get das Categorias
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

    
    // Função de formato da lista de Produtos
    function montarLinha(prod){
        var linha = 
                "<tr>" +
                     "<td>" + prod.id + "</td>" +
                     "<td>"+prod.estoque+"</td>" +
                     "<td>" + prod.preco + "</btd>" +
                     "<td>" + prod.categoria_id + "<td>" +                     
                    '<button class="btn btn-dark" onclick="editar('+ prod.id +')"> Editar </button> ' +
                    '<button class="btn btn-danger" onclick="excluir('+prod.id+')">  Excluir </button>' +
                "</tr>";
        return linha;
    }

    // Get dos Produtos
    function carregarProdutos(){
        $.getJSON('/api/produtos',function(produto){        
            for(i=0;i<produto.length;i++){
                linha = montarLinha(produto[i]);
                $('#tabelaProduto>tbody').append(linha);           
            }   
        });
    }
    
    // Inserindo Produtos

    function criarProdutos(){
        prod = {
            estoque: $('#estoqueProduto').val(),
            preco: $('#precoProduto').val(),
            categoria_id:$('#categoriaProduto').val()
        };                    
        $.post("/api/produtos",prod,function(data){
                produto = JSON.parse(data);
                linha  = montarLinha(produto);
                $('#tabelaProduto>tbody').append(linha);
        })
    }

    // Removendo Produtos
    function excluir(id){
        $.ajax({
            type:"DELETE",
            url: "api/produtos/" + id,
            context: this,
            sucess: function(){
                console.log('Apagou');
                linhas = $("#tabelaProduto>tbody>tr");
                e = linhas.filter(function(i,elemento){
                    return elemento.cells[0].textContent == id;
                });
                if(e)
                    e.remove();

            },
            error: function(){
                console.log(err);
            }
        })
    }

    function editar(id){
        $.getJSON('/api/produtos/'+id,function(produto){        
            $('#id').val(produto.id);
            $('#estoqueProduto').val(produto.estoque);
            $('#precoProduto').val(produto.preco);
            $('#categoriaProduto').val(produto.categoria_id);
            $('#dlgProdutos').modal('show')  
        });
    }
    

    // Escolhendo se estou inserindo ou editando
    $("#formProduto").submit(function(event){
        event.preventDefault();
        if($("#id").val() != ''){
            salvarProdutos();
        }
        else
            criarProdutos();
        
        $('#dlgProdutos').modal('hide');
    })

    function salvarProdutos(){
        prod = {
            id : $('#id').val(),
            estoque: $('#estoqueProduto').val(),
            preco: $('#precoProduto').val(),
            categoria_id:$('#categoriaProduto').val()
        };
        
        $.ajax({
            type:"PUT",
            url: "api/produtos/" + prod.id,
            data: prod,
            context: this,
            sucess: function(data){
                prod = JSON.parse(data);
                linhas = $("#tabelaProduto>tbody>tr")
                e = linhas.filter(function(i,e){
                    return (e.cells[0].textContent == prod.id)  ;
                });
                if(e)
                    e[0].cells[0].textContent = prod.id;
                    e[0].cells[1].textContent = prod.estoque;
                    e[0].cells[2].textContent = prod.preco;
                    e[0].cells[3].textContent = prod.categoria_id;

            },
            error: function(){
                console.log(err);
            }
        })
    };

    $(function(){
        carregarCategorias();
        carregarProdutos();
    })
    
</script>
@endsection