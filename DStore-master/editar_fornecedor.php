<?php

include_once("config.php");

$dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);

if (empty($dados['idFornecedor'])) {
  $retorna = ['status' => false, 'msg' => "<div class='alert alert-danger' 
    role='alert'>Erro: Tente mais tarde!</div>"];
} elseif (empty($dados['nomeFornecedor'])) {
  $retorna = ['status' => false, 'msg' => "<div class='alert alert-danger' 
    role='alert'>Erro: necessario preencher o campo nome!</div>"];
} elseif (empty($dados['cnpj'])) {
  $retorna = ['status' => false, 'msg' => "<div class='alert alert-danger' 
    role='alert'>Erro: necessario preencher o campo CNPJ!</div>"];
} elseif (empty($dados['telefoneFornecedor'])) {
  $retorna = ['status' => false, 'msg' => "<div class='alert alert-danger' 
    role='alert'>Erro: necessario preencher o campo telefone!</div>"];
} elseif (empty($dados['emailFornecedor'])) {
  $retorna = ['status' => false, 'msg' => "<div class='alert alert-danger' 
    role='alert'>Erro: necessario preencher o campo email!</div>"];
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
  $query_fornecedor = "UPDATE fornecedor SET nomeFornecedor = :nomeFornecedor, cnpj = :cnpj, telefoneFornecedor = :telefoneFornecedor, emailFornecedor = :emailFornecedor, cep = :cep, estado = :estado, cidade = :cidade WHERE idFornecedor = :idFornecedor";

  $edit_fornecedor = $conn->prepare($query_fornecedor);
  $edit_fornecedor->bindParam(':nomeFornecedor', $dados['nomeFornecedor']);
  $edit_fornecedor->bindParam(':cnpj', $dados['cnpj']);
  $edit_fornecedor->bindParam(':telefoneFornecedor', $dados['telefoneFornecedor']);
  $edit_fornecedor->bindParam(':emailFornecedor', $dados['emailFornecedor']);
  $edit_fornecedor->bindParam(':cep', $dados['cep']);
  $edit_fornecedor->bindParam(':estado', $dados['estado']);
  $edit_fornecedor->bindParam(':cidade', $dados['cidade']);
  $edit_fornecedor->bindParam(':idFornecedor', $dados['idFornecedor']);

  if ($edit_fornecedor->execute()) {
    $retorna = ['status' => true, 'msg' => "<div class='alert alert-success' 
  role='alert'>Fornecedor foi alterado com sucesso!</div>"];
  } else {
    $retorna = ['status' => false, 'msg' => "<div class='alert alert-danger' 
      role='alert'>Erro: não foi possivel editar o fornecedor!</div>"];
  }
}

echo json_encode($retorna);
