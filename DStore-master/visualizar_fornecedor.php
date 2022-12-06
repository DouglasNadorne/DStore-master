<?php

// incluir a conexão com o banco de dados
include_once("config.php");

$idFornecedor = filter_input(INPUT_GET, "idFornecedor", FILTER_SANITIZE_NUMBER_INT);

if (!empty($idFornecedor)) {
  $query_fornecedor = "SELECT * FROM fornecedor WHERE idFornecedor = :idFornecedor LIMIT 1";
  $result_fornecedor = $conn->prepare($query_fornecedor);
  $result_fornecedor->bindParam(":idFornecedor", $idFornecedor);
  $result_fornecedor->execute();

  if (($result_fornecedor) and ($result_fornecedor->rowCount() != 0)) {
    $row_fornecedor = $result_fornecedor->fetch(PDO::FETCH_ASSOC);
    $retorna = ['status' => true, 'dados' => $row_fornecedor];
  } else {
    $retorna = ['status' => false, 'msg' => "<div class='alert alert-danger' 
    role='alert'>Erro: Nenhum fornecedor encontrado!</div>"];
  }
} else {
  $retorna = ['status' => false, 'msg' => "<div class='alert alert-danger' 
    role='alert'>Erro: Nenhum fornecedor encontrado!</div>"];
}
echo json_encode($retorna);
