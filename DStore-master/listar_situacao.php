<?php

include_once("config.php");

$query_sits = "SELECT * FROM fornecedor ORDER BY nomeFornecedor ASC";
$result_sits = $conn->prepare($query_sits);
$result_sits->execute();

if (($result_sits) and ($result_sits->rowCount() != 0)) {
    while ($row_sits = $result_sits->fetch(PDO::FETCH_ASSOC)) {
        extract($row_sits);
        $dados[] = [
            'idFornecedor' => $idFornecedor,
            'nomeFornecedor' => $nomeFornecedor
        ];
    }
    $retorna = ['status' => true, 'dados' => $dados];
} else {
    $retorna = ['status' => false, 'msg' => "<div class='alert alert-danger' 
      role='alert'>Erro: não foi encontrado nenhum registro!</div>"];
}
echo json_encode($retorna);
