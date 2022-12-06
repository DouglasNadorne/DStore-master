<?php

// incluir a conexão com o banco de dados
include_once("config.php");

$idProduto = filter_input(INPUT_GET, "idProduto", FILTER_SANITIZE_NUMBER_INT);

if (!empty($idProduto)) {
  $query_produto = "SELECT * FROM produto WHERE idProduto = :idProduto LIMIT 1";
  $result_produto = $conn->prepare($query_produto);
  $result_produto->bindParam(":idProduto", $idProduto);
  $result_produto->execute();

  if (($result_produto) and ($result_produto->rowCount() != 0)) {
    $row_produto = $result_produto->fetch(PDO::FETCH_ASSOC);
    $retorna = ['status' => true, 'dados' => $row_produto];
  } else {
    $retorna = ['status' => false, 'msg' => "<div class='alert alert-danger' 
    role='alert'>Erro: Nenhum produto encontrado!</div>"];
  }
} else {
  $retorna = ['status' => false, 'msg' => "<div class='alert alert-danger' 
    role='alert'>Erro: Nenhum produto encontrado!</div>"];
}
echo json_encode($retorna);
