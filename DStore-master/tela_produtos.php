<?php include("dashboard.php") ?>
<div class="container">
    <div class="d-flex justify-content-between align-items-center pt-3 pb-2">
        <h1 class="display-5 mb-4">Produtos cadastrados</h1>
        <!-- Button relatorios -->
        <a href="gerar_relatorio_produto.php" style="text-decoration: none;"><button href="" type="button" class="btn btn-outline-dark ">
                Relatorio </button></a>
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-outline-primary " data-bs-toggle="modal" data-bs-target="#cadProdutoModal">
            Cadastrar </button>
    </div>

    <span id="msgAlerta"></span>

    <table id="listar-produto" class="table table-striped table-hover display" style="width:110%">
        <thead>
            <tr>
                <th>Id</th>
                <th>Nome</th>
                <th>Descrição</th>
                <th>Preço</th>
                <th>Fornecedor</th>
                <th>Categoria</th>
                <th>Data de fabricação</th>
                <th>Quantidade</th>
                <th>Imagem</th>

                <th>Ações</th>
            </tr>
        </thead>
    </table>
</div>
<!--Parei aqui-->
<!-- Modal cadastrar-->
<div class="modal fade" id="cadProdutoModal" tabindex="-1" aria-labelledby="cadProdutoModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="cadProdutoModalLabel">Detalhes Produto</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <span id="msgAlertErroCad"></span>
                <form class="row g-3" method="POST" id="form-cad-produto">
                    <div class="col-md-6">
                        <label for="nomeProduto" class="form-label">Nome</label>
                        <input type="text" name="nomeProduto" class="form-control" id="nomeProduto" placeholder="Nome do Produto">
                    </div>

                    <div class="col-12">
                        <label for="descricaoProduto" class="form-label">Descrição</label>
                        <input type="text" name="descricaoProduto" class="form-control" id="descricaoProduto" placeholder="Descrição do produto">
                    </div>

                    <div class="col-md-4">
                        <label for="precoProduto" class="form-label">Preço</label>
                        <input type="text" name="precoProduto" class="form-control" id="precoProduto" step="0.01" min="0.01" placeholder="Valor">
                    </div>

                    <div class="col-md-4">
                        <label for="idFornecedor" class="form-label">Fornecedores</label>
                        <select id="idFornecedor" name="idFornecedor" class="form-select">
                            <option selected> </option>
                        </select>
                    </div>

                    <div class="col-md-4">
                        <label for="idCategoria" class="form-label">Categorias</label>
                        <select id="idCategoria" name="idCategoria" class="form-select">
                            <option selected>Selecione a Categoria</option>
                            <option>Periféricos</option>
                            <option>Processadores</option>
                            <option>Placas de vídeo</option>
                            <option>Eletronicos</option>
                        </select>
                    </div>

                    <div class="col-md-4">
                        <label for="dataFabricacao" class="form-label">Data de fabricação</label>
                        <input type="date" name="dataFabricacao" class="form-control" id="dataFabricacao">
                    </div>

                    <div class="col-md-4">
                        <label for="qtdeProduto" class="form-label">Quantidade</label>
                        <input type="number" name="qtdeProduto" class="form-control" id="qtdeProduto" placeholder="Quantidade">
                    </div>

                    <div class="input-group mb-3">
                        <input type="file" id="imagemProduto" name="imagemProduto" id="imagemProduto"><br><br>
                    </div>

                    <div class="col-12">
                        <button type="submit" class="btn btn-outline-primary btn-sm" value="cadastrar">Cadastrar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal visualizar-->
<div class="modal fade" id="visProdutoModal" tabindex="-1" aria-labelledby="visProdutoModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="visProdutoModalLabel">Detalhes do Produto</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <dl class="row">
                    <dt class="col-sm-3">ID</dt>
                    <dd class="col-sm-9"><span id="idProduto"></span></dd>

                    <dt class="col-sm-3">Nome</dt>
                    <dd class="col-sm-9"><span id="nomesProduto"></span></dd>

                    <dt class="col-sm-3">Descrição</dt>
                    <dd class="col-sm-9"><span id="descricaoProdutos"></span></dd>

                    <dt class="col-sm-3">Preço</dt>
                    <dd class="col-sm-9"><span id="precoProdutos"></span></dd>

                    <dt class="col-sm-3">Fornecedor</dt>
                    <dd class="col-sm-9"><span id="fornecedorProdutos"></span></dd>

                    <dt class="col-sm-3">Categoria</dt>
                    <dd class="col-sm-9"><span id="categoriaProdutos"></span></dd>

                    <dt class="col-sm-3">Fabricação</dt>
                    <dd class="col-sm-9"><span id="dataFabricacaos"></span></dd>

                    <dt class="col-sm-3">Quantidade</dt>
                    <dd class="col-sm-9"><span id="qtdeProdutos"></span></dd>

                </dl>
            </div>
        </div>
    </div>
</div>

<!-- Modal Editar-->
<div class="modal fade" id="editProdutoModal" tabindex="-1" aria-labelledby="editProdutoModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="editProdutoModalLabel">Detalhes Produto</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <span id="msgAlertErroEdit"></span>
                <form class="row g-3" method="POST" id="form-edit-produto">
                    <input type="hidden" name="idProduto" class="form-control" id="editIdProduto">

                    <div class="col-md-6">
                        <label for="nomeProduto" class="form-label">Nome</label>
                        <input type="text" name="nomeProduto" class="form-control" id="editNomesProduto" placeholder="Nome do Produto">
                    </div>
                    <div class="col-12">
                        <label for="descricaoProduto" class="form-label">Descrição</label>
                        <input type="text" name="descricaoProduto" class="form-control" id="editDescricaoProdutos" placeholder="Descrição do produto">
                    </div>

                    <div class="col-md-4">
                        <label for="precoProduto" class="form-label">Preço</label>
                        <input type="text" name="precoProduto" class="form-control" id="editPrecoProdutos" step="0.01" min="0.01" placeholder="Valor">
                    </div>

                    <div class="col-md-4">
                        <label for="idFornecedor" class="form-label">Fornecedores</label>
                        <select id="editFornecedorProdutos" name="idFornecedor" class="form-select">
                            <option> </option>
                        </select>
                    </div>

                    <div class="col-md-4">
                        <label for="idCategoria" class="form-label">Categorias</label>
                        <select id="editCategoriaProdutos" name="idCategoria" class="form-select">
                            <option selected>Selecione a Categoria</option>
                            <option>Periféricos</option>
                            <option>Processadores</option>
                            <option>Placas de vídeo</option>
                            <option>Eletronicos</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label for="dataFabricacao" class="form-label">Data de fabricação</label>
                        <input type="date" name="dataFabricacao" class="form-control" id="editDataFabricacaos">
                    </div>
                    <div class="col-md-4">
                        <label for="qtdeProduto" class="form-label">Quantidade</label>
                        <input type="number" name="qtdeProduto" class="form-control" id="editQtdeProdutos" placeholder="Quantidade">
                    </div>
                    <div class="input-group mb-2">
                        <input type="file" id="editImagemProdutos" name="imagemProduto" id="imagemProduto"><br><br>
                    </div>

                    <div class="col-12">
                        <button type="submit" class="btn btn-outline-primary btn-sm" value="salvar">Salvar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    $('#precoProduto').mask('000.000.000.000.000,00', {
        reverse: true
    });
    $('#editPrecoProdutos').mask('000.000.000.000.000,00', {
        reverse: true
    });
</script>


<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>
<script src="https://cdn.datatables.net/1.13.1/js/dataTables.bootstrap5.min.js"></script>
<script src="./js/table/custom_produto.js"></script>

<?php include("rodape.php") ?>