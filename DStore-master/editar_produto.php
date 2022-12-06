<?php

include_once("config.php");

$dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);

if (empty($dados['idProduto'])) {
  $retorna = ['status' => false, 'msg' => "<div class='alert alert-danger' 
    role='alert'>Erro: Tente mais tarde!</div>"];
} elseif (empty($dados['nomeProduto'])) {
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
    role='alert'>Erro: necessario selecionar a categoria!</div>"];
} elseif (empty($dados['dataFabricacao'])) {
  $retorna = ['status' => false, 'msg' => "<div class='alert alert-danger' 
    role='alert'>Erro: necessario preencher o campo data de fabricação!</div>"];
} elseif (empty($dados['qtdeProduto'])) {
  $retorna = ['status' => false, 'msg' => "<div class='alert alert-danger' 
    role='alert'>Erro: necessario preencher o campo quantidade!</div>"];
} else {
  $query_produto = "UPDATE produto SET nomeProduto=:nomeProduto, descricaoProduto=:descricaoProduto, 
    precoProduto=:precoProduto, idFornecedor=:idFornecedor, idCategoria=:idCategoria,
    dataFabricacao=:dataFabricacao, qtdeProduto=:qtdeProduto, imagemProduto=:imagemProduto WHERE idProduto = :idProduto";

  $edit_produto = $conn->prepare($query_produto);
  $edit_produto->bindParam(':nomeProduto', $dados['nomeProduto']);
  $edit_produto->bindParam(':descricaoProduto', $dados['descricaoProduto']);
  $edit_produto->bindParam(':precoProduto', $dados['precoProduto']);
  $edit_produto->bindParam(':idFornecedor', $dados['idFornecedor']);
  $edit_produto->bindParam(':idCategoria', $dados['idCategoria']);
  $edit_produto->bindParam(':dataFabricacao', $dados['dataFabricacao']);
  $edit_produto->bindParam(':qtdeProduto', $dados['qtdeProduto']);
  $edit_produto->bindParam(':imagemProduto', $dados['imagemProduto']);
  $edit_produto->bindParam(':idProduto', $dados['idProduto']);

  if ($edit_produto->execute()) {
    $retorna = ['status' => true, 'msg' => "<div class='alert alert-success' 
        role='alert'>Produto foi alterado com sucesso!</div>"];
  } else {
    $retorna = ['status' => false, 'msg' => "<div class='alert alert-danger' 
        role='alert'>Erro: não foi possivel editar o produto!</div>"];
  }
}

echo json_encode($retorna);
