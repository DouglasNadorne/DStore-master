<?php

include_once("config.php");

$dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);

if (empty($dados['idCliente'])) {
    $retorna = ['status' => false, 'msg' => "<div class='alert alert-danger' 
    role='alert'>Erro: Tente mais tarde!</div>"];
} elseif (empty($dados['nomeCliente'])) {
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
    role='alert'>Erro: necessario selecionar a data de nascimento!</div>"];
} elseif (empty($dados['telefone_cliente'])) {
    $retorna = ['status' => false, 'msg' => "<div class='alert alert-danger' 
    role='alert'>Erro: necessario preencher o campo telefone!</div>"];
} elseif (empty($dados['cep'])) {
    $retorna = ['status' => false, 'msg' => "<div class='alert alert-danger' 
    role='alert'>Erro: necessario preencher o campo CEP!</div>"];
} elseif (empty($dados['estado'])) {
    $retorna = ['status' => false, 'msg' => "<div class='alert alert-danger' 
    role='alert'>Erro: necessario selecionar o estado!</div>"];
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
    $query_cliente = "UPDATE cliente SET nomeCliente=:nomeCliente, cpf=:cpf, 
    emailCliente=:emailCliente, genero=:genero, data_nascimento=:data_nascimento,
    telefone_cliente=:telefone_cliente, cep=:cep, estado=:estado, cidade=:cidade,
    rua=:rua, numero=:numero WHERE idCliente = :idCliente";

    $edit_cliente = $conn->prepare($query_cliente);
    $edit_cliente->bindParam(':nomeCliente', $dados['nomeCliente']);
    $edit_cliente->bindParam(':cpf', $dados['cpf']);
    $edit_cliente->bindParam(':emailCliente', $dados['emailCliente']);
    $edit_cliente->bindParam(':genero', $dados['genero']);
    $edit_cliente->bindParam(':data_nascimento', $dados['data_nascimento']);
    $edit_cliente->bindParam(':telefone_cliente', $dados['telefone_cliente']);
    $edit_cliente->bindParam(':cep', $dados['cep']);
    $edit_cliente->bindParam(':estado', $dados['estado']);
    $edit_cliente->bindParam(':cidade', $dados['cidade']);
    $edit_cliente->bindParam(':rua', $dados['rua']);
    $edit_cliente->bindParam(':numero', $dados['numero']);
    $edit_cliente->bindParam(':idCliente', $dados['idCliente']);

    if ($edit_cliente->execute()) {
        $retorna = ['status' => true, 'msg' => "<div class='alert alert-success' 
    role='alert'>Cliente foi alterado com sucesso!</div>"];
    } else {
        $retorna = ['status' => false, 'msg' => "<div class='alert alert-danger' 
        role='alert'>Erro: não foi possivel editar o cliente!</div>"];
    }
}

echo json_encode($retorna);
