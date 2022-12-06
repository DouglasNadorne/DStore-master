<?php

include_once("config.php");

$dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);

if (empty($dados['id'])) {
  $retorna = ['status' => false, 'msg' => "<div class='alert alert-danger' 
    role='alert'>Erro: Tente mais tarde!</div>"];
} elseif (empty($dados['nome'])) {
  $retorna = ['status' => false, 'msg' => "<div class='alert alert-danger' 
    role='alert'>Erro: necessario preencher o campo nome!</div>"];
} elseif (empty($dados['email'])) {
  $retorna = ['status' => false, 'msg' => "<div class='alert alert-danger' 
    role='alert'>Erro: necessario preencher o campo email!</div>"];
} elseif (empty($dados['data_nascimento'])) {
  $retorna = ['status' => false, 'msg' => "<div class='alert alert-danger' 
    role='alert'>Erro: necessario selecionar a data de nascimento!</div>"];
} elseif (empty($dados['cpf'])) {
  $retorna = ['status' => false, 'msg' => "<div class='alert alert-danger' 
    role='alert'>Erro: necessario preencher o campo CPF!</div>"];
} elseif (empty($dados['cargo'])) {
  $retorna = ['status' => false, 'msg' => "<div class='alert alert-danger' 
    role='alert'>Erro: necessario preencher o campo cargo!</div>"];
} elseif (empty($dados['cep'])) {
  $retorna = ['status' => false, 'msg' => "<div class='alert alert-danger' 
    role='alert'>Erro: necessario preencher o campo CEP!</div>"];
} elseif (empty($dados['estado'])) {
  $retorna = ['status' => false, 'msg' => "<div class='alert alert-danger' 
    role='alert'>Erro: necessario selecionar o estado!</div>"];
} elseif (empty($dados['cidade'])) {
  $retorna = ['status' => false, 'msg' => "<div class='alert alert-danger' 
    role='alert'>Erro: necessario preencher o campo cidade!</div>"];
} else {
  $query_usuario = "UPDATE usuario SET nome=:nome, email=:email, 
    data_nascimento=:data_nascimento, cpf=:cpf,
    cargo=:cargo, cep=:cep, estado=:estado, cidade=:cidade WHERE id = :id";

  $edit_usuario = $conn->prepare($query_usuario);
  $edit_usuario->bindParam(':nome', $dados['nome']);
  $edit_usuario->bindParam(':email', $dados['email']);
  $edit_usuario->bindParam(':data_nascimento', $dados['data_nascimento']);
  $edit_usuario->bindParam(':cpf', $dados['cpf']);
  $edit_usuario->bindParam(':cargo', $dados['cargo']);
  $edit_usuario->bindParam(':cep', $dados['cep']);
  $edit_usuario->bindParam(':estado', $dados['estado']);
  $edit_usuario->bindParam(':cidade', $dados['cidade']);

  $edit_usuario->bindParam(':id', $dados['id']);

  if ($edit_usuario->execute()) {
    $retorna = ['status' => true, 'msg' => "<div class='alert alert-success' 
      role='alert'>Usuário foi alterado com sucesso!</div>"];
  } else {
    $retorna = ['status' => false, 'msg' => "<div class='alert alert-danger' 
      role='alert'>Erro: não foi possivel editar o usuário!</div>"];
  }
}

echo json_encode($retorna);
