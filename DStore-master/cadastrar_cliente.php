<?php

include_once("config.php");

$dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);

if (empty($dados['nomeCliente'])) {
    $retorna = ['status' => false, 'msg' => "<div class='alert alert-danger' 
    role='alert'>Erro: necessario preencher o campo nome!</div>"];
} elseif (empty($dados['cpf'])) {
    $retorna = ['status' => false, 'msg' => "<div class='alert alert-danger' 
    role='alert'>Erro: necessario preencher o campo CPF!</div>"];
} elseif (empty($dados['emailCliente'])) {
    $retorna = ['status' => false, 'msg' => "<div class='alert alert-danger' 
    role='alert'>Erro: necessario preencher o campo email!</div>"];
} elseif (empty($dados['genero'])) {
    $retorna = ['status' => false, 'msg' => "<div class='alert alert-danger' 
    role='alert'>Erro: necessario selecionar o genero!</div>"];
} elseif (empty($dados['data_nascimento'])) {
    $retorna = ['status' => false, 'msg' => "<div class='alert alert-danger' 
    role='alert'>Erro: necessario preencher a data de nascimento!</div>"];
} elseif (empty($dados['telefone_cliente'])) {
    $retorna = ['status' => false, 'msg' => "<div class='alert alert-danger' 
    role='alert'>Erro: necessario preencher o campo telefone!</div>"];
} elseif (empty($dados['cep'])) {
    $retorna = ['status' => false, 'msg' => "<div class='alert alert-danger' 
    role='alert'>Erro: necessario preencher o campo cep!</div>"];
} elseif (empty($dados['estado'])) {
    $retorna = ['status' => false, 'msg' => "<div class='alert alert-danger' 
    role='alert'>Erro: necessario selecionar estado!</div>"];
} elseif (empty($dados['cidade'])) {
    $retorna = ['status' => false, 'msg' => "<div class='alert alert-danger' 
    role='alert'>Erro: necessario preencher o campo cidade!</div>"];
} elseif (empty($dados['rua'])) {
    $retorna = ['status' => false, 'msg' => "<div class='alert alert-danger' 
    role='alert'>Erro: necessario preencher o campo rua!</div>"];
} elseif (empty($dados['numero'])) {
    $retorna = ['status' => false, 'msg' => "<div class='alert alert-danger' 
    role='alert'>Erro: necessario preencher o campo numero!</div>"];
} else {
    $query_clientes = "INSERT INTO cliente (nomeCliente, cpf, emailCliente, genero, data_nascimento, telefone_cliente, cep, estado, cidade, rua, numero) VALUE (:nomeCliente, :cpf, :emailCliente, :genero, :data_nascimento, :telefone_cliente, :cep, :estado, :cidade, :rua, :numero)";

    $cad_clientes = $conn->prepare($query_clientes);
    $cad_clientes->bindParam(':nomeCliente', $dados['nomeCliente']);
    $cad_clientes->bindParam(':cpf', $dados['cpf']);
    $cad_clientes->bindParam(':emailCliente', $dados['emailCliente']);
    $cad_clientes->bindParam(':genero', $dados['genero']);
    $cad_clientes->bindParam(':data_nascimento', $dados['data_nascimento']);
    $cad_clientes->bindParam(':telefone_cliente', $dados['telefone_cliente']);
    $cad_clientes->bindParam(':cep', $dados['cep']);
    $cad_clientes->bindParam(':estado', $dados['estado']);
    $cad_clientes->bindParam(':cidade', $dados['cidade']);
    $cad_clientes->bindParam(':rua', $dados['rua']);
    $cad_clientes->bindParam(':numero', $dados['numero']);
    $cad_clientes->execute();

    if ($cad_clientes->rowCount()) {
        $retorna = ['status' => true, 'msg' => "<div class='alert alert-success' role='alert'> Cliente foi cadastrado com sucesso!</div>"];
    } else {
        $retorna = ['status' => false, 'msg' => "<div class='alert alert-danger' role='alert'>Erro: não foi possivel cadastrar o cliente!</div>"];
    }
}

echo json_encode($retorna);
