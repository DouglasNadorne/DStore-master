<?php

// Carregar o Composer
require "./relatorios/vendor/autoload.php";

//Conexão com o banco de dados
include_once './config.php';
include("./confiig.php");

// QUERY para recuperar os registros do banco de dados
$query_vendas = mysqli_query($conn, "SELECT *, nomeProduto, nome, nomeCliente FROM venda v INNER JOIN produto p ON p.idProduto = v.idProduto INNER JOIN usuario u ON u.id = v.idUsuario INNER JOIN cliente c ON c.idCliente = v.idCliente");

// Informacoes para o PDF
$dados = "<!DOCTYPE html>";
$dados .= "<html lang='pt-br'>";
$dados .= "<head>";
$dados .= "<meta charset='UTF-8'>";
$dados .= "<link rel='stylesheet' href='styles/crudProduto.css'";
$dados .= "<title>Relatório de Vendas</title>";
$dados .= "</head>";
$dados .= "<body>";
$dados .= "<h1>Lista de Pedidos</h1>";

// Ler os registros retornado do BD
while ($row_venda = mysqli_fetch_assoc($query_vendas)) {
  //var_dump($row_usuario);
  extract($row_venda);
  $dados .= "Produto: $nomeProduto <br>";
  $dados .= "Funcionário: $nome <br>";
  $dados .= "Cliente: $nomeCliente <br>";
  $dados .= "Valor: $valorTotal <br>";
  $dados .= "Data: $data <br>";
  $dados .= "<hr>";
}

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

ob_end_clean();

// Gerar o PDF
$dompdf->stream("Relatório de vendas");
