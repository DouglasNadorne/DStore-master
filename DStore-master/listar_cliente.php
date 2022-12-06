<?php

// Incluir a conexão com o banco de dados
include_once('./config.php');

//Recebe os dados da requisição
$dados_requisicao = $_REQUEST;

//Lista de colunas na tabela
$colunas = [
    0 => 'idCliente',
    1 => 'nomeCliente',
    2 => 'genero',
    3 => 'cpf',
    4 => 'emailCliente',
    5 => 'telefone_cliente',
    6 => 'data_nascimento',
    7 => 'cep',
    8 => 'estado',
    9 => 'cidade',
    10 => 'rua',
    11 => 'numero'
];


// Obter a quantidade de registros no banco de dados
$query_qnt_clientes = "SELECT COUNT(idCliente) AS qnt_clientes FROM cliente";
if (!empty($dados_requisicao['search']['value'])) {
    $query_qnt_clientes .= " Where idCliente LIKE :id ";
    $query_qnt_clientes .= " OR nomeCliente LIKE :nome";
    $query_qnt_clientes .= " OR genero LIKE :genero";
    $query_qnt_clientes .= " OR cpf LIKE :cpf";
    $query_qnt_clientes .= " OR emailCliente LIKE :emailCliente";
    $query_qnt_clientes .= " OR telefone_cliente LIKE :telefone_cliente";
    $query_qnt_clientes .= " OR cep LIKE :cep";
    $query_qnt_clientes .= " OR estado LIKE :estado";
    $query_qnt_clientes .= " OR cidade LIKE :cidade";
    $query_qnt_clientes .= " OR rua LIKE :rua";
}

//Preparar a QUERY
$result_qnt_clientes = $conn->prepare($query_qnt_clientes);
//Acessa o IF quando ha parametros de pesquisa
if (!empty($dados_requisicao['search']['value'])) {
    $valor_pesq = "%" . $dados_requisicao['search']['value'] . "%";
    $result_qnt_clientes->bindParam(':id', $valor_pesq, PDO::PARAM_STR);
    $result_qnt_clientes->bindParam(':nome', $valor_pesq, PDO::PARAM_STR);
    $result_qnt_clientes->bindParam(':genero', $valor_pesq, PDO::PARAM_STR);
    $result_qnt_clientes->bindParam(':cpf', $valor_pesq, PDO::PARAM_STR);
    $result_qnt_clientes->bindParam(':emailCliente', $valor_pesq, PDO::PARAM_STR);
    $result_qnt_clientes->bindParam(':telefone_cliente', $valor_pesq, PDO::PARAM_STR);
    $result_qnt_clientes->bindParam(':cep', $valor_pesq, PDO::PARAM_STR);
    $result_qnt_clientes->bindParam(':estado', $valor_pesq, PDO::PARAM_STR);
    $result_qnt_clientes->bindParam(':cidade', $valor_pesq, PDO::PARAM_STR);
    $result_qnt_clientes->bindParam(':rua', $valor_pesq, PDO::PARAM_STR);
}
$result_qnt_clientes->execute();
$row_qtd_clientes = $result_qnt_clientes->fetch(PDO::FETCH_ASSOC);


// Recuperar os registros no banco de dados
$query_clientes = "SELECT * 
                    FROM cliente ";

//Acessa o IF quando ha parametros de pesquisa
if (!empty($dados_requisicao['search']['value'])) {
    $query_clientes .= " Where idCliente LIKE :id ";
    $query_clientes .= " OR nomeCliente LIKE :nome";
    $query_clientes .= " OR genero LIKE :genero";
    $query_clientes .= " OR cpf LIKE :cpf";
    $query_clientes .= " OR emailCliente LIKE :emailCliente";
    $query_clientes .= " OR telefone_cliente LIKE :telefone_cliente";
    $query_clientes .= " OR cep LIKE :cep";
    $query_clientes .= " OR estado LIKE :estado";
    $query_clientes .= " OR cidade LIKE :cidade";
    $query_clientes .= " OR rua LIKE :rua";
}

//Ordenar os registros
$query_clientes .= " ORDER BY " . $colunas[$dados_requisicao['order'][0]['column']] . " " .
    $dados_requisicao['order'][0]['dir'] . " LIMIT :inicio, :quantidade";

$result_clientes = $conn->prepare($query_clientes);
$result_clientes->bindParam(':inicio', $dados_requisicao['start'], PDO::PARAM_INT);
$result_clientes->bindParam(':quantidade', $dados_requisicao['length'], PDO::PARAM_INT);

//Acessa o IF quando ha parametros de pesquisa
if (!empty($dados_requisicao['search']['value'])) {
    $valor_pesq = "%" . $dados_requisicao['search']['value'] . "%";
    $result_clientes->bindParam(':id', $valor_pesq, PDO::PARAM_STR);
    $result_clientes->bindParam(':nome', $valor_pesq, PDO::PARAM_STR);
    $result_clientes->bindParam(':genero', $valor_pesq, PDO::PARAM_STR);
    $result_clientes->bindParam(':cpf', $valor_pesq, PDO::PARAM_STR);
    $result_clientes->bindParam(':emailCliente', $valor_pesq, PDO::PARAM_STR);
    $result_clientes->bindParam(':telefone_cliente', $valor_pesq, PDO::PARAM_STR);
    $result_clientes->bindParam(':cep', $valor_pesq, PDO::PARAM_STR);
    $result_clientes->bindParam(':estado', $valor_pesq, PDO::PARAM_STR);
    $result_clientes->bindParam(':cidade', $valor_pesq, PDO::PARAM_STR);
    $result_clientes->bindParam(':rua', $valor_pesq, PDO::PARAM_STR);
}

//Execultar a QUERY
$result_clientes->execute();

while ($row_cliente = $result_clientes->fetch(PDO::FETCH_ASSOC)) {
    extract($row_cliente);
    $registro = [];
    $registro[] = $idCliente;
    $registro[] = $nomeCliente;
    $registro[] = $genero;
    $registro[] = $cpf;
    $registro[] = $emailCliente;


    $registro[] = "<button type='button' id='$idCliente' class='btn btn-outline-dark btn-sm' onclick='visCliente($idCliente)'>Visualizar</button>   <button type='button' id='$idCliente' class='btn btn-outline-warning btn-sm' onclick='editCliente($idCliente)'>Editar</button>   <button type='button' id='$idCliente' class='btn btn-outline-danger btn-sm' onclick='apagarCliente($idCliente)'>Excluir</button>";
    $dados_cliente[] = $registro;
}

//Cria o array de informações a serem retornadas no JavaScript
$resultado = [
    "draw" => intval($dados_requisicao['draw']), //para cada requisição é enviado um numero como parametro
    "recordsTotal" => intval($row_qtd_clientes['qnt_clientes']), //quantidade de registros que há no banco de dados
    "recordsFiltered" => intval($row_qtd_clientes['qnt_clientes']), //total de registros quando houver pesquisa
    "data" => $dados_cliente //Array de dados com os registros retornados da tabela cliente
];

//Retorna os dados em formato de objeto para o JavaScript
echo json_encode($resultado);
