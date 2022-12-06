<?php

// incluir a conexão com o banco de dados
include_once("config.php");

$idCliente = filter_input(INPUT_GET, "idCliente", FILTER_SANITIZE_NUMBER_INT);

if (!empty($idCliente)) {
    $query_cliente = "SELECT * FROM cliente WHERE idCliente = :idCliente LIMIT 1";
    $result_cliente = $conn->prepare($query_cliente);
    $result_cliente->bindParam(":idCliente", $idCliente);
    $result_cliente->execute();

    if (($result_cliente) and ($result_cliente->rowCount() != 0)) {
        $row_cliente = $result_cliente->fetch(PDO::FETCH_ASSOC);
        $retorna = ['status' => true, 'dados' => $row_cliente];
    } else {
        $retorna = ['status' => false, 'msg' => "<div class='alert alert-danger' 
    role='alert'>Erro: Nenhum usuario encontrado!</div>"];
    }
} else {
    $retorna = ['status' => false, 'msg' => "<div class='alert alert-danger' 
    role='alert'>Erro: Nenhum usuario encontrado!</div>"];
}
echo json_encode($retorna);
