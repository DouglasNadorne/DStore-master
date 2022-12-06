<?php

// Carregar o Composer
require "./relatorios/vendor/autoload.php";

//Conexão com o banco de dados
include_once './config.php';

// QUERY para recuperar os registros do banco de dados
$query_fornecedor = "SELECT * FROM fornecedor";

// Prepara a QUERY
$result_fornecedor = $conn->prepare($query_fornecedor);

// Executar a QUERY
$result_fornecedor->execute();

//Informações para o PDF
$dados = "<!DOCTYPE html>";
$dados .= "<html lang='pt-br'>";
$dados .= "<head>";
$dados .= "<meta charset='UTF-8'>";
$dados .= "<link rel='stylesheet' href='http://localhost/DStore/css/custom.css'";
$dados .= "<title>Relatório de fornecedor</title>";
$dados .= "</head>";
$dados .= "<body>";
$dados .= "<h1>Relatório de fornecedor</h1>";

// Ler os registros retornado do BD
while ($row_fornecedor = $result_fornecedor->fetch(PDO::FETCH_ASSOC)) {
    extract($row_fornecedor);
    $dados .= "ID: $idFornecedor <br>";
    $dados .= "Nome: $nomeFornecedor <br>";
    $dados .= "CPF: $cnpj <br>";
    $dados .= "Email: $emailFornecedor <br>";
    $dados .= "Telefone: $telefoneFornecedor <br>";
    $dados .= "Cep: $cep <br>";
    $dados .= "Estado: $estado <br>";
    $dados .= "Cidade: $cidade <br>";
    $dados .= "<hr>";
}

$dados .= "<img src='http://localhost/DStore/imagens/logo_transparentB.png'><br>";
$dados .= "</body>";

// Referenciar o namespace Dompdf
use Dompdf\Dompdf;

// Instanciar e usar a classe dompdf
$dompdf = new Dompdf(['enable_remote' => true]);

// Instanciar o metodo loadHtml e enviar o conteudo do PDF
$dompdf->loadHtml($dados);

// Configurar o tamanho e a orientacao do papel
// landscape - Imprimir no formato paisagem
//$dompdf->setPaper('A4', 'landscape');
// portrait - Imprimir no formato retrato
$dompdf->setPaper('A4', 'portrait');

// Renderizar o HTML como PDF
$dompdf->render();

// Gerar o PDF
$dompdf->stream("Relatório de fornecedor");
