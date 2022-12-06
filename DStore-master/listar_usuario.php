<?php

// Incluir a conexão com o banco de dados
include_once('./config.php');

//Recebe os dados da requisição
$dados_requisicao = $_REQUEST;

//Lista de colunas na tabela
$colunas = [
  0 => 'id',
  1 => 'nome',
  2 => 'email',
  3 => 'data_nascimento',
  4 => 'cpf',
  5 => 'cargo',
  6 => 'cep',
  7 => 'estado',
  8 => 'cidade',
];


// Obter a quantidade de registros no banco de dados
$query_qnt_usuarios = "SELECT COUNT(id) AS qnt_usuarios FROM usuario";
if (!empty($dados_requisicao['search']['value'])) {
  $query_qnt_usuarios .= " Where id LIKE :id ";
  $query_qnt_usuarios .= " OR nome LIKE :nome";
  $query_qnt_usuarios .= " OR email LIKE :email";
  $query_qnt_usuarios .= " OR data_nascimento LIKE :data_nascimento";
  $query_qnt_usuarios .= " OR cpf LIKE :cpf";
  $query_qnt_usuarios .= " OR cargo LIKE :cargo";
  $query_qnt_usuarios .= " OR cep LIKE :cep";
  $query_qnt_usuarios .= " OR estado LIKE :estado";
  $query_qnt_usuarios .= " OR cidade LIKE :cidade";
}

//Preparar a QUERY
$result_qnt_usuarios = $conn->prepare($query_qnt_usuarios);
//Acessa o IF quando ha parametros de pesquisa
if (!empty($dados_requisicao['search']['value'])) {
  $valor_pesq = "%" . $dados_requisicao['search']['value'] . "%";
  $result_qnt_usuarios->bindParam(':id', $valor_pesq, PDO::PARAM_STR);
  $result_qnt_usuarios->bindParam(':nome', $valor_pesq, PDO::PARAM_STR);
  $result_qnt_usuarios->bindParam(':email', $valor_pesq, PDO::PARAM_STR);
  $result_qnt_usuarios->bindParam(':data_nascimento', $valor_pesq, PDO::PARAM_STR);
  $result_qnt_usuarios->bindParam(':cpf', $valor_pesq, PDO::PARAM_STR);
  $result_qnt_usuarios->bindParam(':cargo', $valor_pesq, PDO::PARAM_STR);
  $result_qnt_usuarios->bindParam(':cep', $valor_pesq, PDO::PARAM_STR);
  $result_qnt_usuarios->bindParam(':estado', $valor_pesq, PDO::PARAM_STR);
  $result_qnt_usuarios->bindParam(':cidade', $valor_pesq, PDO::PARAM_STR);
}
$result_qnt_usuarios->execute();
$row_qtd_usuarios = $result_qnt_usuarios->fetch(PDO::FETCH_ASSOC);


// Recuperar os registros no banco de dados
$query_usuarios = "SELECT * 
                    FROM usuario ";

//Acessa o IF quando ha parametros de pesquisa
if (!empty($dados_requisicao['search']['value'])) {
  $query_usuarios .= " Where id LIKE :id ";
  $query_usuarios .= " OR nome LIKE :nome";
  $query_usuarios .= " OR email LIKE :email";
  $query_usuarios .= " OR data_nascimento LIKE :data_nascimento";
  $query_usuarios .= " OR cpf LIKE :cpf";
  $query_usuarios .= " OR cargo LIKE :cargo";
  $query_usuarios .= " OR cep LIKE :cep";
  $query_usuarios .= " OR estado LIKE :estado";
  $query_usuarios .= " OR cidade LIKE :cidade";
}

//Ordenar os registros
$query_usuarios .= " ORDER BY " . $colunas[$dados_requisicao['order'][0]['column']] . " " .
  $dados_requisicao['order'][0]['dir'] . " LIMIT :inicio, :quantidade";

$result_usuarios = $conn->prepare($query_usuarios);
$result_usuarios->bindParam(':inicio', $dados_requisicao['start'], PDO::PARAM_INT);
$result_usuarios->bindParam(':quantidade', $dados_requisicao['length'], PDO::PARAM_INT);

//Acessa o IF quando ha parametros de pesquisa
if (!empty($dados_requisicao['search']['value'])) {
  $valor_pesq = "%" . $dados_requisicao['search']['value'] . "%";
  $result_usuarios->bindParam(':id', $valor_pesq, PDO::PARAM_STR);
  $result_usuarios->bindParam(':nome', $valor_pesq, PDO::PARAM_STR);
  $result_usuarios->bindParam(':email', $valor_pesq, PDO::PARAM_STR);
  $result_usuarios->bindParam(':data_nascimento', $valor_pesq, PDO::PARAM_STR);
  $result_usuarios->bindParam(':cpf', $valor_pesq, PDO::PARAM_STR);
  $result_usuarios->bindParam(':cargo', $valor_pesq, PDO::PARAM_STR);
  $result_usuarios->bindParam(':cep', $valor_pesq, PDO::PARAM_STR);
  $result_usuarios->bindParam(':estado', $valor_pesq, PDO::PARAM_STR);
  $result_usuarios->bindParam(':cidade', $valor_pesq, PDO::PARAM_STR);
}

//Execultar a QUERY
$result_usuarios->execute();

while ($row_usuario = $result_usuarios->fetch(PDO::FETCH_ASSOC)) {
  extract($row_usuario);
  $registro = [];
  $registro[] = $id;
  $registro[] = $nome;
  $registro[] = $email;
  $registro[] = $data_nascimento;
  $registro[] = $cpf;
  $registro[] = $cargo;



  $registro[] = "<button type='button' id='$id' class='btn btn-outline-dark btn-sm' onclick='visUsuario($id)'>Visualizar</button>   <button type='button' id='$id' class='btn btn-outline-warning btn-sm' onclick='editUsuario($id)'>Editar</button>
    <button type='button' id='$id' class='btn btn-outline-danger btn-sm' onclick='apagarUsuario($id)'>Excluir</button>";
  $dados_usuario[] = $registro;
}

//Cria o array de informações a serem retornadas no JavaScript
$resultado = [
  "draw" => intval($dados_requisicao['draw']), //para cada requisição é enviado um numero como parametro
  "recordsTotal" => intval($row_qtd_usuarios['qnt_usuarios']), //quantidade de registros que há no banco de dados
  "recordsFiltered" => intval($row_qtd_usuarios['qnt_usuarios']), //total de registros quando houver pesquisa
  "data" => $dados_usuario //Array de dados com os registros retornados da tabela usuario
];

//Retorna os dados em formato de objeto para o JavaScript
echo json_encode($resultado);
