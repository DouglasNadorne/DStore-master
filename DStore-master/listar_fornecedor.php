<?php

// Incluir a conexão com o banco de dados
include_once('./config.php');

//Recebe os dados da requisição
$dados_requisicao = $_REQUEST;

//Lista de colunas na tabela
$colunas = [
  0 => 'idFornecedor',
  1 => 'nomeFornecedor',
  2 => 'cnpj',
  3 => 'emailFornecedor',
  4 => 'telefoneFornecedor',
  5 => 'cep',
  6 => 'estado',
  7 => 'cidade',
];


// Obter a quantidade de registros no banco de dados
$query_qnt_fornecedores = "SELECT COUNT(idFornecedor) AS qnt_fornecedores FROM fornecedor";
if (!empty($dados_requisicao['search']['value'])) {
  $query_qnt_fornecedores .= " Where idFornecedor LIKE :id ";
  $query_qnt_fornecedores .= " OR nomeFornecedor LIKE :nome";
  $query_qnt_fornecedores .= " OR cnpj LIKE :cnpj";
  $query_qnt_fornecedores .= " OR telefoneFornecedor LIKE :telefoneFornecedor";
  $query_qnt_fornecedores .= " OR emailFornecedor LIKE :emailFornecedor";
  $query_qnt_fornecedores .= " OR cep LIKE :cep";
  $query_qnt_fornecedores .= " OR estado LIKE :estado";
  $query_qnt_fornecedores .= " OR cidade LIKE :cidade";
}

//Preparar a QUERY
$result_qnt_fornecedores = $conn->prepare($query_qnt_fornecedores);
//Acessa o IF quando ha parametros de pesquisa
if (!empty($dados_requisicao['search']['value'])) {
  $valor_pesq = "%" . $dados_requisicao['search']['value'] . "%";
  $result_qnt_fornecedores->bindParam(':id', $valor_pesq, PDO::PARAM_STR);
  $result_qnt_fornecedores->bindParam(':nome', $valor_pesq, PDO::PARAM_STR);
  $result_qnt_fornecedores->bindParam(':cnpj', $valor_pesq, PDO::PARAM_STR);
  $result_qnt_fornecedores->bindParam(':telefoneFornecedor', $valor_pesq, PDO::PARAM_STR);
  $result_qnt_fornecedores->bindParam(':emailFornecedor', $valor_pesq, PDO::PARAM_STR);
  $result_qnt_fornecedores->bindParam(':cep', $valor_pesq, PDO::PARAM_STR);
  $result_qnt_fornecedores->bindParam(':estado', $valor_pesq, PDO::PARAM_STR);
  $result_qnt_fornecedores->bindParam(':cidade', $valor_pesq, PDO::PARAM_STR);
}
$result_qnt_fornecedores->execute();
$row_qtd_fornecedores = $result_qnt_fornecedores->fetch(PDO::FETCH_ASSOC);


// Recuperar os registros no banco de dados
$query_fornecedores = "SELECT * 
                    FROM fornecedor ";

//Acessa o IF quando ha parametros de pesquisa
if (!empty($dados_requisicao['search']['value'])) {
  $query_fornecedores .= " Where idFornecedor LIKE :id ";
  $query_fornecedores .= " OR nomeFornecedor LIKE :nome";
  $query_fornecedores .= " OR cnpj LIKE :cnpj";
  $query_fornecedores .= " OR emailFornecedor LIKE :emailFornecedor";
  $query_fornecedores .= " OR telefoneFornecedor LIKE :telefoneFornecedor";
  $query_fornecedores .= " OR cep LIKE :cep";
  $query_fornecedores .= " OR estado LIKE :estado";
  $query_fornecedores .= " OR cidade LIKE :cidade";
}

//Ordenar os registros
$query_fornecedores .= " ORDER BY " . $colunas[$dados_requisicao['order'][0]['column']] . " " .
  $dados_requisicao['order'][0]['dir'] . " LIMIT :inicio, :quantidade";

$result_fornecedores = $conn->prepare($query_fornecedores);
$result_fornecedores->bindParam(':inicio', $dados_requisicao['start'], PDO::PARAM_INT);
$result_fornecedores->bindParam(':quantidade', $dados_requisicao['length'], PDO::PARAM_INT);

//Acessa o IF quando ha parametros de pesquisa
if (!empty($dados_requisicao['search']['value'])) {
  $valor_pesq = "%" . $dados_requisicao['search']['value'] . "%";
  $result_fornecedores->bindParam(':id', $valor_pesq, PDO::PARAM_STR);
  $result_fornecedores->bindParam(':nome', $valor_pesq, PDO::PARAM_STR);
  $result_fornecedores->bindParam(':cnpj', $valor_pesq, PDO::PARAM_STR);
  $result_fornecedores->bindParam(':telefoneFornecedor', $valor_pesq, PDO::PARAM_STR);
  $result_fornecedores->bindParam(':emailFornecedor', $valor_pesq, PDO::PARAM_STR);
  $result_fornecedores->bindParam(':cep', $valor_pesq, PDO::PARAM_STR);
  $result_fornecedores->bindParam(':estado', $valor_pesq, PDO::PARAM_STR);
  $result_fornecedores->bindParam(':cidade', $valor_pesq, PDO::PARAM_STR);
}

//Execultar a QUERY
$result_fornecedores->execute();

while ($row_fornecedor = $result_fornecedores->fetch(PDO::FETCH_ASSOC)) {
  extract($row_fornecedor);
  $registro = [];
  $registro[] = $idFornecedor;
  $registro[] = $nomeFornecedor;
  $registro[] = $cnpj;
  $registro[] = $telefoneFornecedor;
  $registro[] = $emailFornecedor;
  $registro[] = $cep;
  $registro[] = $estado;
  $registro[] = $cidade;


  $registro[] = "<button type='button' id='$idFornecedor' class='btn btn-outline-dark btn-sm' onclick='visFornecedor($idFornecedor)'>Visualizar</button> <button type='button' id='$idFornecedor' class='btn btn-outline-warning btn-sm' onclick='editFornecedor($idFornecedor)'>Editar</button>
  <button type='button' id='$idFornecedor' class='btn btn-outline-danger btn-sm' onclick='apagarFornecedor($idFornecedor)'>Excluir</button>";
  $dados_fornecedor[] = $registro;
}

//Cria o array de informações a serem retornadas no JavaScript
$resultado = [
  "draw" => intval($dados_requisicao['draw']), //para cada requisição é enviado um numero como parametro
  "recordsTotal" => intval($row_qtd_fornecedores['qnt_fornecedores']), //quantidade de registros que há no banco de dados
  "recordsFiltered" => intval($row_qtd_fornecedores['qnt_fornecedores']), //total de registros quando houver pesquisa
  "data" => $dados_fornecedor //Array de dados com os registros retornados da tabela fornecedor
];

//Retorna os dados em formato de objeto para o JavaScript
echo json_encode($resultado);
