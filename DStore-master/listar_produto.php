<?php

// Incluir a conexão com o banco de dados
include_once('./config.php');

//Recebe os dados da requisição
$dados_requisicao = $_REQUEST;

//Lista de colunas na tabela
$colunas = [
    0 => 'idProduto',
    1 => 'nomeProduto',
    2 => 'descricaoProduto',
    3 => 'precoProduto',
    4 => 'idFornecedor',
    5 => 'idCategoria',
    6 => 'dataFabricacao',
    7 => 'qtdeProduto',
    8 => 'imagemProduto'

];


// Obter a quantidade de registros no banco de dados
$query_qnt_produtos = "SELECT COUNT(idProduto) AS qnt_produtos FROM produto";
if (!empty($dados_requisicao['search']['value'])) {
    $query_qnt_produtos .= " Where idProduto LIKE :id ";
    $query_qnt_produtos .= " OR nomeProduto LIKE :nome";
    $query_qnt_produtos .= " OR descricaoProduto LIKE :descricaoProduto";
    $query_qnt_produtos .= " OR precoProduto LIKE :precoProduto";
    $query_qnt_produtos .= " OR idFornecedor LIKE :idFornecedor";
    $query_qnt_produtos .= " OR idCategoria LIKE :idCategoria";
    $query_qnt_produtos .= " OR dataFabricacao LIKE :dataFabricacao";
    $query_qnt_produtos .= " OR qtdeProduto LIKE :qtdeProduto";
    $query_qnt_produtos .= " OR imagemProduto LIKE :imagemProduto";
}

//Preparar a QUERY
$result_qnt_produtos = $conn->prepare($query_qnt_produtos);
//Acessa o IF quando ha parametros de pesquisa
if (!empty($dados_requisicao['search']['value'])) {
    $valor_pesq = "%" . $dados_requisicao['search']['value'] . "%";
    $result_qnt_produtos->bindParam(':id', $valor_pesq, PDO::PARAM_STR);
    $result_qnt_produtos->bindParam(':nome', $valor_pesq, PDO::PARAM_STR);
    $result_qnt_produtos->bindParam(':descricaoProduto', $valor_pesq, PDO::PARAM_STR);
    $result_qnt_produtos->bindParam(':precoProduto', $valor_pesq, PDO::PARAM_STR);
    $result_qnt_produtos->bindParam(':idFornecedor', $valor_pesq, PDO::PARAM_STR);
    $result_qnt_produtos->bindParam(':idCategoria', $valor_pesq, PDO::PARAM_STR);
    $result_qnt_produtos->bindParam(':dataFabricacao', $valor_pesq, PDO::PARAM_STR);
    $result_qnt_produtoss->bindParam(':qtdeProduto', $valor_pesq, PDO::PARAM_STR);
    $result_qnt_produtoss->bindParam(':imagemProduto', $valor_pesq, PDO::PARAM_STR);
}
$result_qnt_produtos->execute();
$row_qtd_produtos = $result_qnt_produtos->fetch(PDO::FETCH_ASSOC);


// Recuperar os registros no banco de dados
$query_produtos = "SELECT * 
                    FROM produto";

//Acessa o IF quando ha parametros de pesquisa
if (!empty($dados_requisicao['search']['value'])) {
    $query_produtos .= " Where idProduto LIKE :id ";
    $query_produtos .= " OR nomeProduto LIKE :nome";
    $query_produtos .= " OR descricaoProduto LIKE :descricaoProduto";
    $query_produtos .= " OR precoProduto LIKE :precoProduto";
    $query_produtos .= " OR idFornecedor LIKE :idFornecedor";
    $query_produtos .= " OR idCategoria LIKE :idCategoria";
    $query_produtos .= " OR dataFabricacao LIKE :dataFabricacao";
    $query_produtos .= " OR qtdeProduto LIKE :qtdeProduto";
    $query_produtos .= " OR imagemProduto LIKE :imagemProduto";
}

//Ordenar os registros
$query_produtos .= " ORDER BY " . $colunas[$dados_requisicao['order'][0]['column']] . " " .
    $dados_requisicao['order'][0]['dir'] . " LIMIT :inicio, :quantidade";

$result_produtos = $conn->prepare($query_produtos);
$result_produtos->bindParam(':inicio', $dados_requisicao['start'], PDO::PARAM_INT);
$result_produtos->bindParam(':quantidade', $dados_requisicao['length'], PDO::PARAM_INT);

//Acessa o IF quando ha parametros de pesquisa
if (!empty($dados_requisicao['search']['value'])) {
    $valor_pesq = "%" . $dados_requisicao['search']['value'] . "%";
    $result_produtos->bindParam(':id', $valor_pesq, PDO::PARAM_STR);
    $result_produtos->bindParam(':nomeProduto', $valor_pesq, PDO::PARAM_STR);
    $result_produtos->bindParam(':descricaoProduto', $valor_pesq, PDO::PARAM_STR);
    $result_produtos->bindParam(':precoProduto', $valor_pesq, PDO::PARAM_STR);
    $result_produtos->bindParam(':idFornecedor', $valor_pesq, PDO::PARAM_STR);
    $result_produtos->bindParam(':idCategoria', $valor_pesq, PDO::PARAM_STR);
    $result_produtos->bindParam(':dataFabricacao', $valor_pesq, PDO::PARAM_STR);
    $result_produtoss->bindParam(':qtdeProduto', $valor_pesq, PDO::PARAM_STR);
    $result_produtoss->bindParam(':imagemProduto', $valor_pesq, PDO::PARAM_STR);
}

//Execultar a QUERY
$result_produtos->execute();

while ($row_produtos = $result_produtos->fetch(PDO::FETCH_ASSOC)) {
    extract($row_produtos);
    $registro = [];
    $registro[] = $idProduto;
    $registro[] = $nomeProduto;
    $registro[] = $descricaoProduto;
    $registro[] = $precoProduto;
    $registro[] = $idFornecedor;
    $registro[] = $idCategoria;
    $registro[] = $dataFabricacao;
    $registro[] = $qtdeProduto;
    $registro[] = $imagemProduto;

    $registro[] = "<button type='button' id='$idProduto' class='btn btn-outline-dark btn-sm' onclick='visProduto($idProduto)'>Visualizar</button> <button type='button' id='$idProduto' class='btn btn-outline-warning btn-sm' onclick='editProduto($idProduto)'>Editar</button>
  <button type='button' id='$idProduto' class='btn btn-outline-danger btn-sm' onclick='apagarProduto($idProduto)'>Excluir</button>";
    $dados_produto[] = $registro;
}

//Cria o array de informações a serem retornadas no JavaScript
$resultado = [
    "draw" => intval($dados_requisicao['draw']), //para cada requisição é enviado um numero como parametro
    "recordsTotal" => intval($row_qtd_produtos['qnt_produtos']), //quantidade de registros que há no banco de dados
    "recordsFiltered" => intval($row_qtd_produtos['qnt_produtos']), //total de registros quando houver pesquisa
    "data" => $dados_produto //Array de dados com os registros retornados da tabela produto
];

//Retorna os dados em formato de objeto para o JavaScript
echo json_encode($resultado);
