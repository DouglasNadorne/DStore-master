<?php

include_once("config.php");

$dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);

if (empty($dados['nomeFornecedor'])) {
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
    role='alert'>Erro: necessario selecionar o email!</div>"];
} elseif (empty($dados['cep'])) {
  $retorna = ['status' => false, 'msg' => "<div class='alert alert-danger' 
    role='alert'>Erro: necessario preencher a CEP!</div>"];
} elseif (empty($dados['estado'])) {
  $retorna = ['status' => false, 'msg' => "<div class='alert alert-danger' 
    role='alert'>Erro: necessario preencher o campo estado!</div>"];
} elseif (empty($dados['cidade'])) {
  $retorna = ['status' => false, 'msg' => "<div class='alert alert-danger'
    role='alert'>Erro: necessario preencher o campo cidade!"];
} else {
  $query_fornecedores = "INSERT INTO fornecedor (nomeFornecedor, cnpj, telefoneFornecedor, emailFornecedor, cep, estado, cidade)
    VALUE (:nomeFornecedor, :cnpj, :telefoneFornecedor, :emailFornecedor, :cep, :estado, :cidade)";

  $cad_fornecedores = $conn->prepare($query_fornecedores);
  $cad_fornecedores->bindParam(':nomeFornecedor', $dados['nomeFornecedor']);
  $cad_fornecedores->bindParam(':cnpj', $dados['cnpj']);
  $cad_fornecedores->bindParam(':telefoneFornecedor', $dados['telefoneFornecedor']);
  $cad_fornecedores->bindParam(':emailFornecedor', $dados['emailFornecedor']);
  $cad_fornecedores->bindParam(':cep', $dados['cep']);
  $cad_fornecedores->bindParam(':estado', $dados['estado']);
  $cad_fornecedores->bindParam(':cidade', $dados['cidade']);
  $cad_fornecedores->execute();

  if ($cad_fornecedores->rowCount()) {
    $retorna = ['status' => true, 'msg' => "<div class='alert alert-success' role='alert'> Fornecedor foi cadastrado com sucesso!</div>"];
  } else {
    $retorna = ['status' => false, 'msg' => "<div class='alert alert-danger' role='alert'>Erro: não foi possivel cadastrar o fornecedor!</div>"];
  }
}

echo json_encode($retorna);
