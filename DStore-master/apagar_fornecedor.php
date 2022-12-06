<?php

include_once("config.php");

$idFornecedor = filter_input(INPUT_GET, "idFornecedor", FILTER_SANITIZE_NUMBER_INT);

if (!empty($idFornecedor)) {
  $query_fornecedor = "DELETE FROM fornecedor WHERE idFornecedor = :idFornecedor";
  $result_fornecedor = $conn->prepare($query_fornecedor);
  $result_fornecedor->bindParam(":idFornecedor", $idFornecedor, PDO::PARAM_INT);

  if ($result_fornecedor->execute()) {
    $retorna = ['status' => true, 'msg' => "<div class='alert alert-success' 
        role='alert'>Fornecedor foi apagado com sucesso!</div>"];
  } else {
    $retorna = ['status' => false, 'msg' => "<div class='alert alert-danger' 
        role='alert'>Erro: não foi possivel apagar o fornecedor!</div>"];
  }
} else {
  $retorna = ['status' => false, 'msg' => "<div class='alert alert-danger' 
        role='alert'>Erro: não foi possivel apagar o fornecedor2!</div>"];
}


echo json_encode($retorna);
