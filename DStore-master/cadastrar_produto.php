<?php

include_once("config.php");

$dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);

if (empty($dados['nomeProduto'])) {
    $retorna = ['status' => false, 'msg' => "<div class='alert alert-danger' 
        role='alert'>Erro: necessario preencher o campo nome!</div>"];
} elseif (empty($dados['descricaoProduto'])) {
    $retorna = ['status' => false, 'msg' => "<div class='alert alert-danger' 
        role='alert'>Erro: necessario preencher o campo descrição!</div>"];
} elseif (empty($dados['precoProduto'])) {
    $retorna = ['status' => false, 'msg' => "<div class='alert alert-danger' 
        role='alert'>Erro: necessario preencher o campo preço!</div>"];
} elseif (empty($dados['idFornecedor'])) {
    $retorna = ['status' => false, 'msg' => "<div class='alert alert-danger' 
        role='alert'>Erro: necessario selecionar o fornecedor!</div>"];
} elseif (empty($dados['idCategoria'])) {
    $retorna = ['status' => false, 'msg' => "<div class='alert alert-danger' 
        role='alert'>Erro: necessario preencher a categoria!</div>"];
} elseif (empty($dados['dataFabricacao'])) {
    $retorna = ['status' => false, 'msg' => "<div class='alert alert-danger' 
        role='alert'>Erro: necessario preencher o campo data!</div>"];
} elseif (empty($dados['qtdeProduto'])) {
    $retorna = ['status' => false, 'msg' => "<div class='alert alert-danger'
        role='alert'>Erro: necessario preencher o campo quantidade!"];
} else {
    $query_produtos = "INSERT INTO produto (nomeProduto, descricaoProduto, precoProduto, idFornecedor, idCategoria, dataFabricacao, qtdeProduto, imagemProduto)
    VALUE (:nomeProduto, :descricaoProduto, :precoProduto, :idFornecedor, :idCategoria, :dataFabricacao, :qtdeProduto, :imagemProduto)";

    $cad_produtos = $conn->prepare($query_produtos);
    $cad_produtos->bindParam(':nomeProduto', $dados['nomeProduto']);
    $cad_produtos->bindParam(':descricaoProduto', $dados['descricaoProduto']);
    $cad_produtos->bindParam(':precoProduto', $dados['precoProduto']);
    $cad_produtos->bindParam(':idFornecedor', $dados['idFornecedor']);
    $cad_produtos->bindParam(':idCategoria', $dados['idCategoria']);
    $cad_produtos->bindParam(':dataFabricacao', $dados['dataFabricacao']);
    $cad_produtos->bindParam(':qtdeProduto', $dados['qtdeProduto']);
    $cad_produtos->bindParam(':imagemProduto', $dados['imagemProduto']);
    $cad_produtos->execute();

    if ($cad_produtos->rowCount()) {
        $retorna = ['status' => true, 'msg' => "<div class='alert alert-success' role='alert'> Produto foi cadastrado com sucesso!</div>"];
    } else {
        $retorna = ['status' => false, 'msg' => "<div class='alert alert-danger' role='alert'>Erro: não foi possivel cadastrar o produto!</div>"];
    }
}

echo json_encode($retorna);
