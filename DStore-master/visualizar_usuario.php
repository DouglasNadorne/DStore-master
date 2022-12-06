<?php

// incluir a conexão com o banco de dados
include_once("config.php");

$id = filter_input(INPUT_GET, "id", FILTER_SANITIZE_NUMBER_INT);

if (!empty($id)) {
  $query_usuario = "SELECT * FROM usuario WHERE id = :id LIMIT 1";
  $result_usuario = $conn->prepare($query_usuario);
  $result_usuario->bindParam(":id", $id);
  $result_usuario->execute();

  if (($result_usuario) and ($result_usuario->rowCount() != 0)) {
    $row_usuario = $result_usuario->fetch(PDO::FETCH_ASSOC);
    $retorna = ['status' => true, 'dados' => $row_usuario];
  } else {
    $retorna = ['status' => false, 'msg' => "<div class='alert alert-danger' 
    role='alert'>Erro: Nenhum usuário encontrado!</div>"];
  }
} else {
  $retorna = ['status' => false, 'msg' => "<div class='alert alert-danger' 
    role='alert'>Erro: Nenhum usuário encontrado!</div>"];
}
echo json_encode($retorna);
