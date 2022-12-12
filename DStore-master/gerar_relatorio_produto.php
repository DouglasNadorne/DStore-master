<?php

// Carregar o Composer
require "./relatorios/vendor/autoload.php";

//Conexão com o banco de dados
include_once './config.php';

// QUERY para recuperar os registros do banco de dados
$query_produtos = "SELECT * FROM produto";

// Prepara a QUERY
$result_produtos = $conn->prepare($query_produtos);

// Executar a QUERY
$result_produtos->execute();

//Informações para o PDF
$dados = "<!DOCTYPE html>";
$dados .= "<html lang='pt-br'>";
$dados .= "<head>";
$dados .= "<meta charset='UTF-8'>";
$dados .= "<link rel='stylesheet' href='http://localhost/DStore/css/custom.css'";
$dados .= "<title>Relatório de produtos</title>";
$dados .= "</head>";
$dados .= "<body>";
$dados .= "<h1>Relatório de produtos</h1>";

// Ler os registros retornado do BD
while ($row_produtos = $result_produtos->fetch(PDO::FETCH_ASSOC)) {
    extract($row_produtos);
    $dados .= "ID: $idProduto <br>";
    $dados .= "Nome: $nomeProduto <br>";
    $dados .= "Descição: $descricaoProduto <br>";
    $dados .= "Preço: $precoProduto <br>";
    $dados .= "Fornecedor: $idFornecedor <br>";
    $dados .= "Categoria: $idCategoria <br>";
    $dados .= "Quantidade: $qtdeProduto <br>";
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
$dompdf->stream("Relatório de produtos");
