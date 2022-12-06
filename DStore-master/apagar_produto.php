<?php

include_once("config.php");

$idProduto = filter_input(INPUT_GET, "idProduto", FILTER_SANITIZE_NUMBER_INT);

if (!empty($idProduto)) {
  $query_produto = "DELETE FROM produto WHERE idProduto = :idProduto";
  $result_produto = $conn->prepare($query_produto);
  $result_produto->bindParam(":idProduto", $idProduto, PDO::PARAM_INT);

  if ($result_produto->execute()) {
    $retorna = ['status' => true, 'msg' => "<div class='alert alert-success' 
        role='alert'>Produto foi apagado com sucesso!</div>"];
  } else {
    $retorna = ['status' => false, 'msg' => "<div class='alert alert-danger' 
        role='alert'>Erro: não foi possivel apagar o produto!</div>"];
  }
} else {
  $retorna = ['status' => false, 'msg' => "<div class='alert alert-danger' 
        role='alert'>Erro: não foi possivel apagar o produto!</div>"];
}


echo json_encode($retorna);
