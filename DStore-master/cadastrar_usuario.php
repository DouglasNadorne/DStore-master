<?php

include_once("config.php");

$dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);

if (empty($dados['nome'])) {
  $retorna = ['status' => false, 'msg' => "<div class='alert alert-danger' 
    role='alert'>Erro: necessario preencher o campo nome!</div>"];
} elseif (empty($dados['email'])) {
  $retorna = ['status' => false, 'msg' => "<div class='alert alert-danger' 
    role='alert'>Erro: necessario preencher o campo email!</div>"];
} elseif (empty($dados['data_nascimento'])) {
  $retorna = ['status' => false, 'msg' => "<div class='alert alert-danger' 
    role='alert'>Erro: necessario preencher a data de nascimento!</div>"];
} elseif (empty($dados['cpf'])) {
  $retorna = ['status' => false, 'msg' => "<div class='alert alert-danger' 
    role='alert'>Erro: necessario preencher o campo CPF!</div>"];
} elseif (empty($dados['cargo'])) {
  $retorna = ['status' => false, 'msg' => "<div class='alert alert-danger' 
    role='alert'>Erro: necessario preencher o campo cargo!</div>"];
} elseif (empty($dados['cep'])) {
  $retorna = ['status' => false, 'msg' => "<div class='alert alert-danger' 
    role='alert'>Erro: necessario preencher o campo cep!</div>"];
} elseif (empty($dados['estado'])) {
  $retorna = ['status' => false, 'msg' => "<div class='alert alert-danger' 
    role='alert'>Erro: necessario selecionar estado!</div>"];
} elseif (empty($dados['cidade'])) {
  $retorna = ['status' => false, 'msg' => "<div class='alert alert-danger' 
    role='alert'>Erro: necessario preencher o campo cidade!</div>"];
} elseif (empty($dados['senha'])) {
  $retorna = ['status' => false, 'msg' => "<div class='alert alert-danger' 
    role='alert'>Erro: necessario preencher o campo senha!</div>"];
} else {
  $query_usuarios = "INSERT INTO usuario (nome, email, data_nascimento, cpf, cargo, cep, estado, cidade, senha) VALUE (:nome, :email, :data_nascimento, :cpf, :cargo, :cep, :estado, :cidade, :senha)";

  $senha = password_hash($dados['senha'], PASSWORD_DEFAULT);

  $cad_usuarios = $conn->prepare($query_usuarios);
  $cad_usuarios->bindParam(':nome', $dados['nome']);
  $cad_usuarios->bindParam(':email', $dados['email']);
  $cad_usuarios->bindParam(':data_nascimento', $dados['data_nascimento']);
  $cad_usuarios->bindParam(':cpf', $dados['cpf']);
  $cad_usuarios->bindParam(':cargo', $dados['cargo']);
  $cad_usuarios->bindParam(':cep', $dados['cep']);
  $cad_usuarios->bindParam(':estado', $dados['estado']);
  $cad_usuarios->bindParam(':cidade', $dados['cidade']);
  $cad_usuarios->bindParam(':senha', $senha);
  $cad_usuarios->execute();

  if ($cad_usuarios->rowCount()) {
    $retorna = ['status' => true, 'msg' => "<div class='alert alert-success' role='alert'> Usuário foi cadastrado com sucesso!</div>"];
  } else {
    $retorna = ['status' => false, 'msg' => "<div class='alert alert-danger' role='alert'>Erro: não foi possivel cadastrar o usuário!</div>"];
  }
}

echo json_encode($retorna);
