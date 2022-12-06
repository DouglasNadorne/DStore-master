<?php

include_once("config.php");

$idCliente = filter_input(INPUT_GET, "idCliente", FILTER_SANITIZE_NUMBER_INT);

if (!empty($idCliente)) {
    $query_cliente = "DELETE FROM cliente WHERE idCliente=:idCliente";
    $result_cliente = $conn->prepare($query_cliente);
    $result_cliente->bindParam(":idCliente", $idCliente, PDO::PARAM_INT);

    if ($result_cliente->execute()) {
        $retorna = ['status' => true, 'msg' => "<div class='alert alert-success' 
        role='alert'>Cliente foi apagado com sucesso!</div>"];
    } else {
        $retorna = ['status' => false, 'msg' => "<div class='alert alert-danger' 
        role='alert'>Erro: não foi possivel apagar o cliente!</div>"];
    }
} else {
    $retorna = ['status' => false, 'msg' => "<div class='alert alert-danger' 
        role='alert'>Erro: não foi possivel apagar o cliente2!</div>"];
}


echo json_encode($retorna);
